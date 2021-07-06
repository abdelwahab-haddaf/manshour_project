<?php

namespace App\Http\Controllers\Web;


use App\Http\Requests\Web\Advertisement\CommentRequest;
use App\Http\Requests\Web\Advertisement\ShowRequest;
use App\Http\Requests\Web\Advertisement\StoreRequest;
use App\Http\Requests\Web\Advertisement\UpdateRequest;
use App\Http\Requests\Web\Advertisement\ResponseToggleFavRequest;
use App\Http\Requests\Web\Advertisement\DeleteRequest;
use App\Http\Requests\Web\Advertisement\SendMessageRequest;
use App\Http\Requests\Web\Advertisement\ResponseRequest;
use App\Http\Requests\Web\Advertisement\CommentPostResponseRequest;
use App\Http\Requests\Web\Advertisement\CommentResponseRequest;
use App\Http\Requests\Web\Advertisement\EditRequest;
use App\Http\Requests\Web\Advertisement\ReportAbuseRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AdvertisementController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(){
        return view('Web.Advertisement.index');
    }
    /**
     * @return Application|Factory|View
     */
    public function create(){
        return view('Web.Advertisement.create');
    }

    /**
     * @param StoreRequest $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(StoreRequest $request){
        return $request->preset();
    }
    /**
     * @param UpdateRequest $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function update(UpdateRequest $request){
        return $request->preset();
    }
    /**
     * @param DeleteRequest $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function delete(DeleteRequest $request){
        return $request->preset();
    }

    /**
     * @param ShowRequest $request
     * @return Application|Factory|View
     */
    public function show(ShowRequest $request){
        return $request->preset();
    }

    /**
     * @param EditRequest $request
     * @return Application|Factory|View
     */
    public function edit(EditRequest $request){
        return $request->preset();
    }
    /**
     * @param SendMessageRequest $request
     * @return Application|Factory|View
     */
    public function send_message(SendMessageRequest $request){
        return $request->preset();
    }

    /**
     * @param ResponseRequest $request
     * @return JsonResponse
     */
    public function response(ResponseRequest $request): JsonResponse
    {
        return $request->preset();
    }

    /**
     * @param CommentResponseRequest $request
     * @return JsonResponse
     */
    public function comment_response(CommentResponseRequest $request): JsonResponse
    {
        return $request->preset();
    }

    /**
     * @param ResponseToggleFavRequest $request
     * @return JsonResponse
     */
    public function response_toggle_fav(ResponseToggleFavRequest $request): JsonResponse
    {
        return $request->preset();
    }
    /**
     * @param ReportAbuseRequest $request
     * @return RedirectResponse
     */
    public function report_abuse(ReportAbuseRequest $request)
    {
        return $request->preset();
    }

    /**
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function comment(CommentRequest $request): RedirectResponse
    {
        return $request->preset();
    }
    /**
     * @param CommentPostResponseRequest $request
     * @return JsonResponse
     */
    public function comment_post_response(CommentPostResponseRequest $request): JsonResponse
    {
        return $request->preset();
    }

}
