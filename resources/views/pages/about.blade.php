



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstraps.min.css" rel="stylesheet">

    <style>
        body {
            padding-top: 45px;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Header section */
        .header {
            position: relative;
            height: 50vh;
            min-height: 200px;
            background-image: url('assets/images/blink_003_878ea00d.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: inset 0 0 0 1000px rgba(0, 0, 0, 0.35);
        }

        
        .table {
            --bs-border-color: black;
        }

        .table-bordered {
            border-width: 2px;

        }


        .table thead th {
            border: 2px solid black !important;
        }

        .table {
            --bs-border-color: black;
        }

        .table-bordered {
            border-width: 2px;
        }

        .table-bordered th,
        .table-bordered td {
            border-width: 2px;
            vertical-align: middle;
            color: rgba(0, 0, 0, 0.35);
        }

        .table-hover tbody tr:hover {
            background-color: black;
        }

        .table img {
            border-radius: 45%;
            max-width: 100px;
            height: auto;
        }



        h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        p {
            line-height: 1.7;
            font-size: 1rem;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- <?php include '../components/header.php'; ?> --}}

@include('layouts.navbar')

    <!-- Header -->
    <header class="bg-light text-center bg-secondary py-2">
        <div class="header">
            <h1>About Us</h1>
            <p> We are the explorers of wild</p>
        </div>
    </header>

    <!-- About Section -->
    <!-- <div class="container my-5">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 id="blog-title">Who We Are</h2>
          <p id="blog-description">
            National Geographic Wild (shortened as Nat Geo Wild and abbreviated NGW) is a global wildlife<br>
            pay television network and the sister network to the National Geographic Channel owned by <br>
            National Geographic Partners, a joint venture between the Walt Disney Company (73%) and the<br>
            National Geographic Society (27%). [2] The channel also broadcasts natural history non-fiction programming.
            The channel ...
          </p>
          <p>
            We provide software development, IT consulting, and digital solutions to help your business grow.
          </p>
        </div>
        <div class="col-md-6 text-center">
          <img src="../assets/images/Geographic_Wild_logo.svg" class="img-fluid rounded" alt="About Image"
            style="width: 150; height: 150px;">
        </div>
      </div>
    </div> -->


    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-8  w-100 mx-auto">

                <!-- Left-aligned heading -->
                <h2 class="mb-4 text-start fw-bold">
                    Who We Are
                </h2>

                <!-- Stronger offset paragraph -->
                <p class=" text-start mt-4" style="font-size: 1rem; font-weight: 450;">
                    National Geographic Wild (shortened as Nat Geo Wild and abbreviated NGW)
                    is a global wildlife pay television network and the sister network to
                    the National Geographic Channel owned by National Geographic Partners,
                    a joint venture between the Walt Disney Company (73%) and the
                    National Geographic Society (27%).<br><br>
                    The channel also broadcasts natural history non-fiction programming.
                    National Geographic Wild, often called Nat Geo Wild or NGW, is a global wildlife television
                    network.
                    It focuses on nature, animals, and wildlife documentaries.
                    Nat Geo Wild is part of the National Geographic family and is owned by National Geographic
                    Partners,
                    a joint venture between the Walt Disney Company and the National Geographic Society.
                    The channel broadcasts programs around the world, bringing viewers closer to the natural
                    world
                </p>

            </div>
        </div>
    </div>



    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered table-hover align-middle w-75 mx-auto">
            <thead class="table-secondary  ">
                <tr>
                    <th>Author </th>
                    <th>Details and description</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td> <img src="assets/images/Jeremy Wade.jpg" alt="Lion lifespan"
                            class="img-fluid rounded mt-2" style="max-width: 150px;"></td>
                    <td>
                        <strong>Jeremy Wade</strong> <i>Date of Birth:</i> <time datetime="1956-03-23">23 March
                            1956</time> <br>
                        Jeremy Wade is a British television presenter and wildlife documentary maker, best known for
                        his work on the
                        Discovery Channel's "River Monsters" series. He has also worked on other wildlife
                        documentaries and has been
                        involved in conservation efforts.
                    </td>
                </tr>

                <tr>
                    <td> <img src="assets/images/Sandesh Kadur.jpg" alt="Lion scientific"
                            class="img-fluid rounded mt-2" style="max-width: 150px;"></td>
                    <td>
                        <strong>Sandesh Kadur</strong> <i>Date of Birth:</i> <time datetime="1976-11-19">19 November
                            1976</time><br>
                        Overview of Sandesh Kadur
                        Background

                        Name: Sandesh Kadur
                        Birth Date: November 19, 1976
                        Birth Place: Bangalore, India
                        Profession: Wildlife filmmaker and conservation photographer

                        Career Highlights

                        Years Active: 2002 - Present
                        Notable Contributions:
                        Worked on BBC's Planet Earth II
                        Directed documentaries for National Geographic
                        Co-founder of Felis Creations, a visual arts company

                        Achievements

                        Board Membership: Appointed to the National Geographic Society's board of trustees in 2024
                        Awards: Recognized for his work in wildlife conservation and storytelling

                        Focus Areas

                        Wildlife Conservation: Highlights endangered species and fragile ecosystems
                        Documentary Filmmaking: Combines education with entertainment to raise awareness

                        Notable Works

                        Secrets of the King Cobra
                        Nilgiris: A Shared Wilderness
                        Return of the Clouded Leopards

                        Philosophy

                        Believes in the power of storytelling to influence conservation efforts and connect people
                        with nature.

                    </td>
                </tr>
                <tr>
                    <td> <img src="assets/images/Robert Caplin.jpg" alt="Savanna habitat"
                            class="img-fluid rounded mt-2" style="max-width: 150px;"></td>
                    <td>
                        <strong>Robert Caplin</strong> <i>Date of Birth:</i> <time datetime="1970-01-01">January 1,
                            1970</time><br>
                        Robert Caplin: Photographer Overview

                        Robert Caplin is an American photographer and photojournalist known for his dynamic work in
                        editorial and
                        commercial photography. He gained prominence through his captivating images of pop culture,
                        particularly his
                        documentation of Justin Bieber's rise to fame. Caplin's career includes contributions to major
                        publications
                        like The New York Times, Sports Illustrated, and National Geographic. He is also the
                        co-founder of The Photo
                        Brigade, an online community for photographers.
                    </td>
                </tr>

                <tr>
                    <td> <img src="assets/images/Ronan_Donovan.jpg" alt="Lion diet" class="img-fluid rounded mt-2"
                            style="max-width: 150px;"></td>
                    <td>
                        <strong>Ronan_Donovan</strong> <i>Date of Birth:</i> <time datetime="1972-05-15">15 May
                            1972</time><br>
                        Overview of Ronan_Donovan
                        Ronan Donovan is an American wildlife biologist, photographer, and filmmaker known for his
                        immersive
                        storytelling about predators and wild ecosystems. A longtime contributor to National
                        Geographic, he gained
                        recognition for his in-depth coverage of wolves in Yellowstone and the Arctic. His work blends
                        science,
                        adventure, and visual narrative to explore animal behavior, conservation challenges, and the
                        complex
                        relationship between humans and the natural world.


                    </td>
                </tr>


                <tr>
                    <td> <img src="assets/images/Tim Butcher.jpg" alt="Conservation status"
                            class="img-fluid rounded mt-2" style="max-width: 150px;"></td>
                    <td>
                        <strong>Tim Butcher</strong> <i>Date of Birth:</i> <time datetime="1965-07-22">22 July
                            1965</time><br>
                        Tim Butcher is a British journalist and author known for his travel writing and historical
                        narratives. He
                        has written several books, including "Blood River," which chronicles his journey through the
                        Congo.
                        Butcher's work often explores themes of adventure, history, and the human condition.
                </tr>
            </tbody>
        </table>
    </div>


    <!-- for future update using dynamic php -->

    <?php
    // $authors = [
    //     [
    //         "name" => "Jeremy Wade",
    //         "dob" => "1956-03-23",
    //         "image" => "../assets/images/Jeremy Wade.jpg",
    //         "description" => " British TV presenter and wildlife documentary maker, known for 'River Monsters'.    Jeremy Wade is a British television presenter and wildlife documentary maker, best known for
    //                   his work on the
    //                   Discovery Channel's River Monsters series. He has also worked on other wildlife
    //                   documentaries and has been
    //                   involved in conservation efforts.  "
    //     ],
    //     [
    //         "name" => "Sandesh Kadur",
    //         "dob" => "1976-11-19",
    //         "image" => "../assets/images/Sandesh Kadur.jpg",
    //         "description" => "Wildlife filmmaker, worked on BBC's Planet Earth II and National Geographic documentaries.Career Highlights

    //                   Years Active: 2002 - Present
    //                   Notable Contributions:
    //                   Worked on BBC's Planet Earth II
    //                   Directed documentaries for National Geographic
    //                   Co-founder of Felis Creations, a visual arts company

    //                   Achievements

    //                   Board Membership: Appointed to the National Geographic Society's board of trustees in 2024
    //                   Awards: Recognized for his work in wildlife conservation and storytelling

    //                   Focus Areas

    //                   Wildlife Conservation: Highlights endangered species and fragile ecosystems
    //                   Documentary Filmmaking: Combines education with entertainment to raise awareness

    //                   Notable Works

    //                   Secrets of the King Cobra
    //                   Nilgiris: A Shared Wilderness
    //                   Return of the Clouded Leopards

    //                   Philosophy

    //                   Believes in the power of storytelling to influence conservation efforts and connect people
    //                   with nature."
    //     ],
    //     [
    //         "name" => "Robert Caplin",
    //         "dob" => "1970-01-01",
    //         "image" => "../assets/images/Robert Caplin.jpg",
    //         "description" => "American photographer and photojournalist, co-founder of The Photo Brigade.

    //          Robert Caplin: Photographer Overview

    //                   Robert Caplin is an American photographer and photojournalist known for his dynamic work in
    //                   editorial and
    //                   commercial photography. He gained prominence through his captivating images of pop culture,
    //                   particularly his
    //                   documentation of Justin Bieber's rise to fame. Caplin's career includes contributions to major
    //                   publications
    //                   like The New York Times, Sports Illustrated, and National Geographic. He is also the
    //                   co-founder of The Photo
    //                   Brigade, an online community for photographers.     "


    //     ],



    //     [
    //         "name" => "Ronan Donovan",
    //         "dob" => "15/05/1972",
    //         "image" => "../assets/images/Ronan_Donovan.jpg",
    //         "description" => "Ronan Donovan is an American wildlife biologist, photographer, and filmmaker known for his immersive storytelling about predators and wild ecosystems. A longtime contributor to National Geographic, he gained recognition for his in-depth coverage of wolves in Yellowstone and the Arctic. His work blends science, adventure, and visual narrative to explore animal behavior, conservation challenges, and the complex relationship between humans and the natural world."
    //     ],

    //     [
    //         "name" => "Tim Butcher",
    //         "dob" => "22/07/1965",
    //         "image" => "../assets/images/Tim%20Butcher.jpg",
    //         "description" => "Tim Butcher is a British journalist and author known for his travel writing and historical narratives. He has written several books, including 'Blood River,' which chronicles his journey through the Congo. Butcher's work often explores themes of adventure, history, and the human condition."
    //     ],


    //     [
    //         "name" => "Ami Vitale",
    //         "dob" => "02/09/1971",
    //         "image" => "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.eoa-assn.org%2Fassets%2FAnnualMeetings%2F2025%2FAmiVitale-200.png&f=1&nofb=1&ipt=6805ace1165e17ff365112959ff7272ff4c74fe6dd0f45ee0b82aa6aa2b67069",
    //         "description" => "Ami Vitale is an award‑winning photojournalist, filmmaker, and National Geographic photographer whose work focuses on wildlife, environmental issues, and human‑wildlife relationships, inspiring action for conservation."
    //     ],

    //     [
    //         "name" => "Joel Sartore",
    //         "dob" => "28/05/1962",
    //         "image" => "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%2Fid%2FOIP.DK8UBK9qtdckki4Ufq2pigHaFQ%3Fpid%3DApi&f=1&ipt=5aa09d8075437c524368873282c37741258dff2b7e676c425413aee33fd0422d&ipo=images",
    //         "description" => "Joel Sartore is an American photographer and conservationist known for his 'Photo Ark' project at National Geographic, documenting endangered species to raise awareness for global biodiversity conservation. "
    //     ],







    // ];
    ?>

    <!-- <div class="table-responsive mt-4">
          <table class="table table-striped table-bordered table-hover align-middle w-75 mx-auto">
              <thead class="table-secondary">
                  <tr>
                      <th style="width: 25%;">Author</th>
                      <th>Details and Description</th>
                  </tr>
              </thead>
              <tbody>
                  < ?php foreach ($authors as $author): ?>
                      <tr>
                          <td>
                              <img src="< ?= $author['image'] ?>" alt="< ?= $author['name'] ?>" class="img-fluid rounded mt-2"
                                  style="max-width:auto; height: 25%;">
                          </td>
                          <td>
                              <strong>< ?= $author['name'] ?></strong>
                              <i>Date of Birth:</i>
                              <time
                                  datetime="< ?= $author['dob'] ?>">< ?= date("d F Y", strtotime($author['dob'])) ?></time><br>
                              < ?= $author['description'] ?>
                          </td>
                      </tr>
                  < ?php endforeach; ?>
              </tbody>
          </table>
      </div> -->

    {{-- <?php include __DIR__ . '/../bootstrap/modals/contact-modal.html'; ?> --}}
    <?php include base_path('bootstrap/modals/contact-modal.html'); ?>

    <!-- Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>

