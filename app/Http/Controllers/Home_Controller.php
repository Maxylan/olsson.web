<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;

class Home_Controller extends Controller
{
    // Properties.
    private $pageTitle = 'Olssons';

    /**
     * Returns the title of pages controlled by the Home_Controller.
     */
    public function GetTitle() {
        return $this->pageTitle;
    }

    /**
     * Returns the view associated with this view controller.
     */
    public function GetView(string $view = '', $args = []) {

        switch($view) {

            case 'home':
                return view('index', (array) $args);

            default:
                return view('index', (array) $args);

        }

    }


    /**
     * Is called by Route to serve a view.
     */
    public function Initialize() {
        
        // Get all background images and transform their paths into URL's.
        $imagefiles = glob( public_path() . '/images' . "/*.jpg" );
        $imagefiles = array_map(function($value) {
            $tmp = explode('/', $value);
            return url( '/'.$tmp[count($tmp) - 2] .'/'.$tmp[count($tmp) - 1] );
        }, $imagefiles);

        return $this->GetView( '', ['title' => $this->GetTitle(), 'backgroundImagePath' => $imagefiles[rand(0, count($imagefiles) - 1)]] );
    }

}
