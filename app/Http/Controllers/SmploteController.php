<?php

namespace App\Http\Controllers;

class SmploteController extends Controller {

    /**
     * smplote index
     *
     * @return string
     * <li> true </li>
     * @author wuj@igancao.com
     * @date 2022/06/24 09:44
     */
    public function index() {
        return 'welcome to smplote.';
    }

    /**
     * awork
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * <li> true </li>
     * @author wuj@igancao.com
     * @date 2022/06/24 22:02
     */
    public function awork() {
        return view('smplote.awork');
    }

}
