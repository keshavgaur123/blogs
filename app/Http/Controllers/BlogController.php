@php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class BlogController extends Controller
// {
// //
// }

// namespace App\Http\Controllers;

// class BlogController extends Controller
// {
// public function index()
// {
// return view('blog.index');
// }

// public function show($id)
// {
// return view('blog.show', compact('id'));
// }
// }


// {-- @php
// $blogPosts = [
// [
// "title" => "Jeremy Wade",
// "image" => "assets/images/Jeremy Wade.jpg",
// "description" => "Jeremy Wade is a British biologist, author, and TV presenter known for River Monsters."
// ],
// [
// "title" => "Pelletier Family",
// "image" => "assets/images/blink_003_878ea00d.jpeg",
// "description" => "Known for strong bonds, nature love, and community spirit."
// ],
// [
// "title" => "Jimmy Chin",
// "image" => "assets/images/jimmychin.jpg",
// "description" => "Climber, photographer, filmmaker, and adventurer."
// ],
// [
// "title" => "Chris Johns",
// "image" => "assets/images/chrisjohns.jpg",
// "description" => "Former National Geographic editor and wildlife photographer."
// ],
// [
// "title" => "Robert Caplin",
// "image" => "assets/images/Robert Caplin.jpg",
// "description" => "Photographer and filmmaker known for storytelling portraits."
// ],
// [
// "title" => "Ira Block",
// "image" => "assets/images/IraBlock.jpg",
// "description" => "National Geographic photographer focused on culture and wildlife."
// ]
// ];
// @endphp --}} -->

// namespace App\Http\Controllers;

class BlogController extends Controller
{
public function index()
{
$blogPosts = [
[
"title" => "Jeremy Wade",
"image" => "assets/images/Jeremy Wade.jpg",
"description" => "Jeremy Wade is a British biologist, author, and TV presenter known for River Monsters."
],
[
"title" => "Pelletier Family",
"image" => "assets/images/blink_003_878ea00d.jpeg",
"description" => "Known for strong bonds, nature love, and community spirit."
],
[
"title" => "Jimmy Chin",
"image" => "assets/images/jimmychin.jpg",
"description" => "Climber, photographer, filmmaker, and adventurer."
],
[
"title" => "Chris Johns",
"image" => "assets/images/chrisjohns.jpg",
"description" => "Former National Geographic editor and wildlife photographer."
],
[
"title" => "Robert Caplin",
"image" => "assets/images/Robert Caplin.jpg",
"description" => "Photographer and filmmaker known for storytelling portraits."
],
[
"title" => "Ira Block",
"image" => "assets/images/IraBlock.jpg",
"description" => "National Geographic photographer focused on culture and wildlife."
]
];

return view('blog.index', compact('blogPosts'));
}

public function show($id)
{
return view('blog.show', compact('id'));
}
}