@extends('layouts.master_old')
<!--==========================
    Intro Section
  ============================-->
@section('content')
    <section id="intro" class="clearfix">
        <div class="container">

            <div class="intro-img">
                <img src="{{asset('old/img/intro-img.svg')}}" alt="" class="img-fluid">
            </div>

            <div class="intro-info">
                <h2>We provide <br><span> OPPORTUNITIES</span><br> for your employment needs!</h2>
                <div>
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    <a href="#services" class="btn-services scrollto">Our Services</a>
                </div>
            </div>

        </div>
    </section><!-- #intro -->

    <main id="main">

        <!--==========================
          About Us Section
        ============================-->
        <section id="about">
            <div class="container">

                <header class="section-header">
                    <h3>Philippine Employment Service Office</h3><br>
                </header>

                <div class="row about-container">

                    <div class="col-lg-6 content order-lg-1 order-2">
                        <p>
                            The Public Employment Service Office (P.E.S.O) is a non-fee charging multi-employment
                            service facility or entity established or accredited pursuant to Republic Act No.
                            8759.<br><br>This is an online platform developed to cater all the services provided by the
                            P.E.S.O - Makati Branch.
                        </p>

                        <div class="icon-box wow fadeInUp">
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <h4 class="title"><a href="">User Driven</a></h4>
                            <p class="description">Employers and Job Applicants may register to create an online
                                community in this platform that provides employment services in the local of Makati.</p>
                        </div>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon"><i class="fa fa-book"></i></div>
                            <h4 class="title"><a href="">Job Catalog</a></h4>
                            <p class="description">This plaform will host different job offerings from different
                                employers, handling multiple number of request from different demographics.</p>
                        </div>

                        <div class="icon-box wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon"><i class="fa fa-bar-chart"></i></div>
                            <h4 class="title"><a href="">Auto-Generated Reports</a></h4>
                            <p class="description">This platform can automatically generate reports based on the
                                Punctuality, Performance and Payment of Employers and their applicants.</p>
                        </div>

                    </div>

                    <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
                        <img src="{{asset('old/img/about-img.svg')}}" class="img-fluid" alt="">
                    </div>
                </div>

                <div class="row about-extra">
                    <div class="col-lg-6 wow fadeInUp">
                        <img src="{{asset('old/img/about-extra-1.svg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 wow fadeInUp pt-5 pt-lg-0">
                        <h4>Opportunities provided by the P.E.S.O Online Platform</h4>
                        <p>
                            This platform is developed to provide employment opportunities to individuals in the locale
                            of Makati, this platform believes that this benefits from reliable access to a larger pool
                            of quality talent, while workers would enjoy freedom and flexibility to find jobs online.
                        </p>
                        <p>
                            Through this Platform work gets more done, connecting with applicaants to work on projects
                            from in different industries. This platform makes it fast, simple, and cost-effective to
                            find, hire, work with, and pay the best professionals anywhere, any time.
                        </p>
                    </div>
                </div>

                <div class="row about-extra">
                    <div class="col-lg-6 wow fadeInUp order-1 order-lg-2">
                        <img src="{{asset('old/img/about-extra-2.svg')}}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 wow fadeInUp pt-4 pt-lg-0 order-2 order-lg-1">
                        <h4>Anyone, Anywhere, Anytime.</h4>
                        <p>
                            It doesn't matter who you are, as long as you have the skills you're gonna find jobs in this
                            plaform, this platform encourages not only the strong workforce but also people with
                            diabilities without being judged with your personality or looks.
                        </p>
                        <p>
                            Do you want to work full time for a big company? or maybe you want to work part-time? You
                            may also want to work at home, it doesn't matter where you are going to work, this platform
                            offers variety of options where to work for businesses in your locale.
                        </p>
                        <p>
                            You want to do multiple jobs? but your current job doesn't allow you to earn as much as you
                            wanted? you're a hard working individual and your time is valuable, this platform will help
                            you manage that.
                        </p>
                    </div>

                </div>

            </div>
        </section><!-- #about -->

        <!--==========================
          Services Section
        ============================-->
        <section id="services" class="section-bg">
            <div class="container">

                <header class="section-header">
                    <h3>Services</h3>
                </header>

                <div class="row">

                    <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-duration="1.4s">
                        <div class="box">
                            <div class="icon"><i class="ion-ios-analytics-outline" style="color: #ff689b;"></i></div>
                            <h4 class="title"><a href="">User Profiling</a></h4>
                            <p class="description">Employers & Applicants may create their accounts that features the
                                profile os the specific user showing their strengths & weaknessess</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-duration="1.4s">
                        <div class="box">
                            <div class="icon"><i class="ion-ios-bookmarks-outline" style="color: #e9bf06;"></i></div>
                            <h4 class="title"><a href="">History Logs</a></h4>
                            <p class="description">Users can see how well they did in the previous project, their
                                evaluation and career growth within the platform</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.1s"
                         data-wow-duration="1.4s">
                        <div class="box">
                            <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
                            <h4 class="title"><a href="">Job Selections</a></h4>
                            <p class="description">With allot of job offerings within your locale, you will never run
                                our of choices as opportunities after opportunities will reveal by itself</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
                        <div class="box">
                            <div class="icon"><i class="ion-ios-speedometer-outline" style="color:#41cf2e;"></i></div>
                            <h4 class="title"><a href="">Boost Potential</a></h4>
                            <p class="description">Do you have a dillemna on what career path you want to take? let us
                                help you make choices with our suggestive system based on your profile</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 offset-lg-1 wow bounceInUp" data-wow-delay="0.2s"
                         data-wow-duration="1.4s">
                        <div class="box">
                            <div class="icon"><i class="ion-ios-world-outline" style="color: #d6ff22;"></i></div>
                            <h4 class="title"><a href="">Online Presence</a></h4>
                            <p class="description">Boost your presence in our online community where people with same
                                career interest can connect and share reviews about your locale</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
                        <div class="box">
                            <div class="icon"><i class="ion-ios-clock-outline" style="color: #4680ff;"></i></div>
                            <h4 class="title"><a href="">Time Management</a></h4>
                            <p class="description">Work at your own phase, do by your rules, work with anyone, anywhere
                                and anytime based on contracts offered in your locale</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- #services -->

        <!--==========================
          Why Us Section
        ============================-->
        <section id="why-us" class="wow fadeIn">
            <div class="container">
                <header class="section-header">
                    <h3>Why use this platform?</h3>
                    <p>This are the following reasons why you should be part of this project.</p>
                </header>

                <div class="row row-eq-height justify-content-center">

                    <div class="col-lg-4 mb-4">
                        <div class="card wow bounceInUp">
                            <i class="fa fa-diamond"></i>
                            <div class="card-body">
                                <h5 class="card-title">Earn by your rules</h5>
                                <p class="card-text">It's your life, it's your choice, you may take multiple projects
                                    within your locale.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card wow bounceInUp">
                            <i class="fa fa-line-chart"></i>
                            <div class="card-body">
                                <h5 class="card-title">Career Growth</h5>
                                <p class="card-text">Reach your full potential by taking different kinds of projects
                                    offered by different employers.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="card wow bounceInUp">
                            <i class="fa fa-object-group"></i>
                            <div class="card-body">
                                <h5 class="card-title">Competitive Platform</h5>
                                <p class="card-text">You are not alone doing this but with a high rating profile you
                                    sure can take advantage of this platform.</p>
                            </div>
                        </div>
                    </div>

                </div>

{{--                <div class="row counters">--}}

{{--                    <div class="col-lg-3 col-6 text-center">--}}
{{--                        <span data-toggle="counter-up">--}}
{{--                            --}}{{--                            TODO :: Update --}}
{{--                            --}}{{--                            {{App\User::where('role',2)->count()}}--}}
{{--                        </span>--}}
{{--                        <p>Employers</p>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-3 col-6 text-center">--}}
{{--                        <span data-toggle="counter-up">--}}
{{--                            --}}{{--                            TODO :: Update --}}
{{--                            --}}{{--                            {{App\Project::count()}}--}}
{{--                        </span>--}}
{{--                        <p>Projects</p>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-3 col-6 text-center">--}}
{{--                        <span data-toggle="counter-up">--}}
{{--                            --}}{{--                            TODO :: Update --}}
{{--                            --}}{{--                            {{App\User::where('role',3)->count()}}--}}
{{--                        </span>--}}
{{--                        <p>Applicants</p>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-3 col-6 text-center">--}}
{{--                        <span data-toggle="counter-up">--}}
{{--                            --}}{{--                            TODO :: Update --}}
{{--                            --}}{{--                            {{App\Job::where('status',true)->count()}}--}}
{{--                        </span>--}}
{{--                        <p>Jobs</p>--}}
{{--                    </div>--}}

{{--                </div>--}}

            </div>
        </section>

        <!--==========================
          Contact Section
        ============================-->
{{--        <section id="contact">--}}
{{--            <div class="container-fluid">--}}

{{--                <div class="section-header">--}}
{{--                    <h3>Contact Us</h3>--}}
{{--                </div>--}}

{{--                <div class="row wow fadeInUp">--}}

{{--                    <div class="col-lg-6">--}}
{{--                        <div class="map mb-4 mb-lg-0">--}}
{{--                            <iframe--}}
{{--                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.6427798973496!2d121.01911471490949!3d14.562408989826796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c9080b52d7f3%3A0xa2cb4d2c393bd945!2sMapua%20University!5e0!3m2!1sen!2sph!4v1572835475674!5m2!1sen!2sph"--}}
{{--                                frameborder="0" style="border:0; width: 100%; height: 312px;" allowfullscreen></iframe>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-6">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-5 info">--}}
{{--                                <i class="ion-ios-location-outline"></i>--}}
{{--                                <p>--}}
{{--                                    --}}{{--                                    TODO :: Update --}}
{{--                                    --}}{{--                                    {{$admin->address}}--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4 info">--}}
{{--                                <i class="ion-ios-email-outline"></i>--}}

{{--                                <p>--}}
{{--                                    --}}{{--                                    TODO :: Update --}}
{{--                                    --}}{{--                                    {{$admin->email}}--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3 info">--}}
{{--                                <i class="ion-ios-telephone-outline"></i>--}}
{{--                                <p>--}}
{{--                                    --}}{{--                                    TODO :: Update --}}
{{--                                    --}}{{--                                    {{$admin->contact}}--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form">--}}
{{--                            <div id="sendmessage">Your message has been sent. Thank you!</div>--}}
{{--                            <div id="errormessage"></div>--}}

{{--                            --}}{{--                                    TODO :: Update Route --}}
{{--                            <form action="/" method="post" role="form" class="contactForm">--}}
{{--                                @csrf--}}
{{--                                <div class="form-row">--}}
{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <input type="text" name="name" class="form-control" id="name"--}}
{{--                                               placeholder="Your Name" data-rule="minlen:4"--}}
{{--                                               data-msg="Please enter at least 4 chars"/>--}}
{{--                                        <div class="validation"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group col-lg-6">--}}
{{--                                        <input type="email" class="form-control" name="email" id="email"--}}
{{--                                               placeholder="Your Email" data-rule="email"--}}
{{--                                               data-msg="Please enter a valid email"/>--}}
{{--                                        <div class="validation"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input type="text" class="form-control" name="subject" id="subject"--}}
{{--                                           placeholder="Subject" data-rule="minlen:4"--}}
{{--                                           data-msg="Please enter at least 8 chars of subject"/>--}}
{{--                                    <div class="validation"></div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <textarea class="form-control" name="message" rows="5" data-rule="required"--}}
{{--                                              data-msg="Please write something for us" placeholder="Message"></textarea>--}}
{{--                                    <div class="validation"></div>--}}
{{--                                </div>--}}
{{--                                <div class="text-center">--}}
{{--                                    <button type="submit" title="Send Message">Send Message</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </section><!-- #contact -->--}}

    </main>
@endsection
