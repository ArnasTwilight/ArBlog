<?php

/** @var yii\web\View $this */

$this->title = 'ArBlog';
?>
<aside class="aside-menu grid--aside">
    <section class="popular">
        <h4 class="aside-menu__title">Popular</h4>
        <div class="line"></div>
        <div class="aside-menu__img">
            <a href="#">
                <img src="public/source/img/Img_min_Post_3.png" alt="popular post">
                <h5 class="min-post-title">Lorem Ipsum</h5>
            </a>
        </div>
        <div class="aside-menu__img">
            <a href="#">
                <img src="public/source/img/Img_min_Post_2.png" alt="popular post">
                <h5 class="min-post-title">Lorem Ipsum</h5>
            </a>
        </div>
        <div class="aside-menu__img">
            <a href="#">
                <img src="public/source/img/Img_min_Post_1.png" alt="popular post">
                <h5 class="min-post-title">Lorem Ipsum</h5>
            </a>
        </div>
    </section>
    <section class="recent">
        <div class="line"></div>
        <h4 class="aside-menu__title">Recent</h4>
        <div class="line"></div>
        <div class="aside-menu__img">
            <a href="#">
                <img src="public/source/img/Img_min_Post_3.png" alt="recent post">
                <h5 class="min-post-title">Lorem Ipsum</h5>
            </a>
        </div>
        <div class="aside-menu__img">
            <a href="#">
                <img src="public/source/img/Img_min_Post_1.png" alt="recent post">
                <h5 class="min-post-title">Lorem Ipsum</h5>
            </a>
        </div>
        <div class="aside-menu__img">
            <a href="#">
                <img src="public/source/img/Img_min_Post_2.png" alt="recent post">
                <h5 class="min-post-title">Lorem Ipsum</h5>
            </a>
        </div>
    </section>
    <section class="category">
        <div class="line"></div>
        <h4 class="aside-menu__title">Category</h4>
        <div class="line"></div>
        <ul class="category-list">
            <li class="category-list__item"><a href="#">Science</a></li>
            <li class="category-list__item"><a href="#">Technology</a></li>
            <li class="category-list__item"><a href="#">Games</a></li>
            <li class="category-list__item"><a href="#">Business</a></li>
            <li class="category-list__item"><a href="#">News</a></li>
            <li class="category-list__item"><a href="#">City</a></li>
            <li class="category-list__item"><a href="#">IT</a></li>
        </ul>
    </section>
</aside>

<main class="main grid--main">
    <article class="post">
        <div class="post__img">
            <img src="public/source/img/Image_Post_3.png" alt="post image">
            <a href="#"><h2 class="post__title">Lorem Ipsum</h2></a>
        </div>
        <div class="post__short-info">
            <h3 class="post__category"><a href="#">Category</a></h3>
            <div class="line"></div>
            <p class="post__description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius metus nec molestie eleifend.
                Donec vel ante eu risus blandit pharetra a at risus. Morbi dapibus risus a odio mattis tempus.
                Suspendisse justo nibh, sodales nec dapibus non, consectetur in arcu. Cras laoreet consectetur
                tortor id pulvinar. Sed sodales nisi nec iaculis efficitur. Praesent dapibus ipsum vitae facilisis
                vestibulum. ...
            </p>
        </div>
    </article>
    <article class="post">
        <div class="post__img">
            <img src="public/source/img/Image_Post_2.png" alt="post image">
            <a href="#"><h2 class="post__title">Lorem Ipsum</h2></a>
        </div>
        <div class="post__short-info">
            <h3 class="post__category"><a href="#">Category</a></h3>
            <div class="line"></div>
            <p class="post__description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius metus nec molestie eleifend.
                Donec vel ante eu risus blandit pharetra a at risus. Morbi dapibus risus a odio mattis tempus.
                Suspendisse justo nibh, sodales nec dapibus non, consectetur in arcu. Cras laoreet consectetur
                tortor id pulvinar. Sed sodales nisi nec iaculis efficitur. Praesent dapibus ipsum vitae facilisis
                vestibulum. ...
            </p>
        </div>
    </article>
    <article class="post">
        <div class="post__img">
            <img src="public/source/img/Image_Post_1.png" alt="post image">
            <a href="#"><h2 class="post__title">Lorem Ipsum</h2></a>
        </div>
        <div class="post__short-info">
            <h3 class="post__category"><a href="#">Category</a></h3>
            <div class="line"></div>
            <p class="post__description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer varius metus nec molestie eleifend.
                Donec vel ante eu risus blandit pharetra a at risus. Morbi dapibus risus a odio mattis tempus.
                Suspendisse justo nibh, sodales nec dapibus non, consectetur in arcu. Cras laoreet consectetur
                tortor id pulvinar. Sed sodales nisi nec iaculis efficitur. Praesent dapibus ipsum vitae facilisis
                vestibulum. ...
            </p>
        </div>
    </article>
</main>
