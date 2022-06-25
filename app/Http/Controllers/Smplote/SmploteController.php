<?php

namespace App\Http\Controllers\Smplote;

use App\Http\Controllers\Controller;

/**
 * Smplote index
 */
class SmploteController extends Controller {

    /**
     * smplote index
     *
     * @return string
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/24 09:44
     */
    public function index() {
        return 'welcome to smplote.';
    }

    /**
     * awork index
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * <li> true </li>
     * @author smplote@gmail.com
     * @date 2022/06/24 22:02
     */
    public function awork() {
        $data = config('smplote.awork');
        return view('smplote.awork', $data);
    }

}
