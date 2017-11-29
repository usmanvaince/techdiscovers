<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <title>Tech Discovers</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">
    <meta name="theme-color" content="#ffffff">
    <link href='https://fonts.googleapis.com/css?family=Miriam+Libre:400,700|Source+Sans+Pro:400,700,600,400italic,700italic'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/front-style.css">

</head>
<body id="site-layout">
<nav class="site-nav">
    <div class="container wrapper">
        <div class="nav__header">
            <a class="nav__logo" href="#">
            </a>
            <button type="button" class="nav__hamburger js-menu-toggle">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </button>
        </div>
        <div class="nav__container js-menu">
            <div class="nav__search">
                <form class="search" action="https://laravel-news.com/search">
                    <input type="text" placeholder="Search" name="q" value="">
                    <button type="submit">

                    </button>
                </form>
            </div>
            <div class="nav__main">
                <ul>
                    <li class="nav__item"><a href="#">Blog</a></li>
                </ul>
            </div>
            <ul class="nav__social social social--lg">
                <li><a rel="nofollow" href="https://twitter.com/laravelnews" class="social__icon icon--twitter">
                    </a></li>
                <li><a rel="nofollow" href="https://www.facebook.com/laravelnews" class="social__icon icon--facebook">
                    </a></li>
            </ul>
            <div class="nav__footer">
                <ol>
                    <!-- bottom links -->
                </ol>
                <img src="/assets/images/dark-ln-elephant.png">
            </div>
        </div>
    </div>
</nav>
<main class="site-main">
    <div class="container wrapper">
        <div class="gutter">
            <div class="md-col md-col-7 lg-col-8">
                @foreach( $posts as $post )
                 <div class="card card--post mt0 mb3">
                    <div class="post__image">
                        <a href="">
                            <img src="{{$post->thumbnail}}" alt="{{ $post->title  }}">
                        </a>
                    </div>
                    <div class="post__content truncate">
                        <span class="text--gray">{{ $post->created_at->toDateString() }}</span>
                        </span>
                        <h2 class="">
                            <a href="#">
                                {{ $post->title  }}
                            </a>
                        </h2>
                        <!-- description -->
                        <div class="description">
                            {{ $post->content  }}
                        </div>


                        <a class="truncate__link" href="#">Read
                                more&hellip;
                        </a>
                    </div>
                    <div class="post__footer">
                        <div class="post__author">
                            <img class="author__image"
                                 src="">
                            <div class="author__content">
                                <h4 class="author__name">by <a href="#">Usman Arshad</a></h4>
                                <ul class="author__links">
                                    <li><span class="twitter"><a></a></span></li>
                                    <li><span class="facebook"><a></a></span></li>
                                    <li><span class="github"><a></a></span></li>
                                </ul>
                            </div>
                        </div>
                        <ul class="tags">
                        </ul>
                    </div>
                </div>
                @endforeach
                {{--<nav class="pagination">
                    <a href="#" class="pagination__arrow arrow--left btn--disabled">
                        Newer Posts</a>
                    <a href="blog4658.html?page=2" class="pagination__arrow arrow--right ">Older Posts
                    </a>
                </nav>--}}
            </div>
            {{--<div class="md-col md-col-5 lg-col-4 sidebar">
                <div class="card sponsor sponsor--block mb3">
                    <span class="sponsor__text"><b>Sponsor</b> / <a href="#" class="link--gray">Become a sponsor</a></span>
                </div>
                <div class="card card--red my3">
                    <div class="card__header">
                        <h2>Newsletter</h2>
                        <img class="header__icon" src="assets/images/min/icon-newsletter.png">
                    </div>
                    <div class="card__content">
                        <p>Join the weekly newsletter and never miss out on new tips, tutorials, and more.</p>
                        <form action="https://laravelnews.createsend.com/t/d/s/owwr/" method="post"
                              class="newsletter-form" data-area="home">
                            <input type="hidden" id="fieldhrcf" name="cm-fd-hrcf-mn" value="11">
                            <input type="hidden" id="fieldhrcfdy" name="cm-fd-hrcf-dy" value="14">
                            <input type="hidden" id="fieldhrcfyr" name="cm-fd-hrcf-yr" value="2017">
                            <div class="input__group">
                                <input class="input__sm" type="email" placeholder="Email Address" name="cm-owwr-owwr"
                                       required>
                                <button class="btn btn--dark-red btn--thin btn--sm newsletter-subscribe">Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card card--gray mb3">
                    <header class="card__header">
                        <h2>Laravel Jobs</h2>
                        <img class="header__icon" src="assets/images/icon-chair.png">
                    </header>
                    <div class="card__content">
                        <dl class="list-unstyled">
                            <dt><a href="https://larajobs.com/job/1047/" class="link--white" rel="nofollow">MYSQL, LINUX
                                    AND PHP DEVELOPER</a></dt>
                            <dd>
                                Hauppauge, NY or Remote
                                <br>39DollarGlasses.com
                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="card sponsor sponsor--block mb3">
                </div>
            </div>--}}
        </div>
    </div>
</main>
<footer class="site-footer">
    <div class="container wrapper">
        <ul class="social social--lg">
            <li><a rel="nofollow" href="https://twitter.com/laravelnews" class="social__icon icon--twitter">
                </a></li>
            <li><a rel="nofollow" href="https://www.facebook.com/laravelnews" class="social__icon icon--facebook">
                </a></li>
            <li><a rel="nofollow" href="https://plus.google.com/+Laravel-news/posts" class="social__icon icon--google">
                </a></li>
            <li><a rel="nofollow" href="https://instagram.com/laravelnews" class="social__icon icon--instagram">
                </a></li>
            <li><a rel="nofollow" href="https://www.linkedin.com/company/laravel-news"
                   class="social__icon icon--linkedin">
                </a></li>
        </ul>
        <nav class="footer__nav">
            <ol>
                <li><a href="#">Links</a></li>
                <li><a href="#">Newsletter</a></li>
                <li><a href="#">Advertise</a></li>
                <li><a href="#">Archive</a></li>
                <li><a href="https://larajobs.com/" rel="nofollow">Jobs</a></li>
                <li><a href="#" rel="nofollow">Your Account</a></li>
                <li><a href="#">Contact</a></li>
            </ol>
        </nav>
        <nav class="footer__nav nav--lighter">
            <ol>
                <li><a href="#">News</a></li>
                <li><a href="#">Tutorials</a></li>
                <li><a href="#">Packages</a></li>
                <li><a href="#">Books</a></li>
                <li><a href="#">Interviews</a></li>
                <li><a href="#">Applications</a></li>
            </ol>
        </nav>
        <div class="footer__copy mt5">
            <img src="assets/images/min/dark-ln-elephant.png">
            <p>&copy; 2012 - 2017 <a href="index.html">Laravel News</a> &mdash; By <a
                        href="https://twitter.com/ericlbarnes">Eric L. Barnes</a> - A division of dotdev inc.</p>
        </div>
        <div class="footer__tribute">
            <p>Design &amp; Front-end code by</p>
            <a href="https://zaengle.com/" class="tribute__logo">
                <span>Zaengle</span>
                <img src="assets/images/min/zaengle-logo.png">
            </a>
        </div>
    </div>
</footer>

<script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
<script src="/js/front-js.js"></script>
</body>
</html>
