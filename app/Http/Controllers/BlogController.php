<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    private function getPosts()
    {
        return [
            [
                "id" => 1,
                "title" => "Jeremy Wade",
                "image" => "assets/images/Jeremy Wade.jpg",
                "description" => "Jeremy Wade is a British biologist, author, and TV presenter known for River Monsters."
            ],
            [
                "id" => 2,
                "title" => "Pelletier Family",
                "image" => "assets/images/blink_003_878ea00d.jpeg",
                "description" => "Known for strong bonds, nature love, and community spirit."
            ],
            [
                "id" => 3,
                "title" => "Jimmy Chin",
                "image" => "assets/images/jimmychin.jpg",
                "description" => "Climber, photographer, filmmaker, and adventurer."
            ],
            // [
            //     "title" => "Chris Johns",
            //     "image" => "assets/images/chrisjohns.jpg",
            //     "description" => "Former National Geographic editor and wildlife photographer."
            // ],
            // [
            //     "title" => "Robert Caplin",
            //     "image" => "assets/images/Robert Caplin.jpg",
            //     "description" => "Photographer and filmmaker known for storytelling portraits."
            // ],
            // [
            //     "title" => "Ira Block",
            //     "image" => "assets/images/IraBlock.jpg",
            //     "description" => "National Geographic photographer focused on culture and wildlife."
            // ]
        ];
    }

    public function index()
    {
        $posts = $this->getPosts();
        return view('pages.home', compact('posts'));
    }

    public function show($id)
    {
        $post = collect($this->getPosts())->firstWhere('id', $id);

        if (!$post) {
            abort(404);
        }

        return view('blog.show', compact('post'));
    }
}
