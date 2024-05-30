<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDatapembayaranRequest;
use App\Http\Requests\StoreDatapembayaranRequest;
use App\Http\Requests\UpdateDatapembayaranRequest;
use App\Models\Datapembayaran;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DatapembayaranController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('datapembayaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datapembayarans = Datapembayaran::with(['media'])->get();

        return view('admin.datapembayarans.index', compact('datapembayarans'));
    }

    public function create()
    {
        abort_if(Gate::denies('datapembayaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datapembayarans.create');
    }

    public function store(StoreDatapembayaranRequest $request)
    {
        $datapembayaran = Datapembayaran::create($request->all());

        if ($request->input('image', false)) {
            $datapembayaran->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $datapembayaran->id]);
        }

        return redirect()->route('admin.datapembayarans.index');
    }

    public function edit(Datapembayaran $datapembayaran)
    {
        abort_if(Gate::denies('datapembayaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datapembayarans.edit', compact('datapembayaran'));
    }

    public function update(UpdateDatapembayaranRequest $request, Datapembayaran $datapembayaran)
    {
        $datapembayaran->update($request->all());

        if ($request->input('image', false)) {
            if (! $datapembayaran->image || $request->input('image') !== $datapembayaran->image->file_name) {
                if ($datapembayaran->image) {
                    $datapembayaran->image->delete();
                }
                $datapembayaran->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($datapembayaran->image) {
            $datapembayaran->image->delete();
        }

        return redirect()->route('admin.datapembayarans.index');
    }

    public function show(Datapembayaran $datapembayaran)
    {
        abort_if(Gate::denies('datapembayaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datapembayarans.show', compact('datapembayaran'));
    }

    public function destroy(Datapembayaran $datapembayaran)
    {
        abort_if(Gate::denies('datapembayaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $datapembayaran->delete();

        return back();
    }

    public function massDestroy(MassDestroyDatapembayaranRequest $request)
    {
        $datapembayarans = Datapembayaran::find(request('ids'));

        foreach ($datapembayarans as $datapembayaran) {
            $datapembayaran->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('datapembayaran_create') && Gate::denies('datapembayaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Datapembayaran();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
