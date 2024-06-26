@extends('layouts.app')
@section('title','Check-Out Page')
@section('content')
<style>
    body {
        font-family: 'Helvetica Neue', Arial, sans-serif; /* Font mặc định */
margin: 0;
padding: 0;
background-color: white;


}

/* header {
background-color: #333;
color: #fff;
text-align: center;
padding: 1em 0;
} */

h1 {
margin: 0;
}

main {
padding: 2em;
}

section {
margin-bottom: 2em;
}

h2 {
font-size: 1.5em;
margin-bottom: 0.5em;
}

.value {

padding: 1em;

margin-bottom: 1em;
}

h3 {
margin-top: 0;
}

footer {
background-color: #333;
color: #fff;
text-align: center;
padding: 1em 0;
}
.full-width-image {
width: 100%;
height: 400px;
object-fit: cover;
max-width: 100%;
display: block;
margin: 0;
padding: 0;
margin-bottom: 20px; /* Thêm khoảng  bỏ padding mặc định */

}
.value {
display: flex;
align-items: center;
margin-bottom: 1em;
}

.value-content {
flex: 1;
padding: 1em;
}

.value img {
max-width: 50%; /* Điều chỉnh kích thước hình ảnh là 50% chiều rộng của màn hình */
height: auto;
margin-left: 1em;
}
/* ... (các phần trước) ... */

.goal-section {
display: flex;
flex-direction: row-reverse; /* Đảo ngược thứ tự của các thành phần */
align-items: center;
margin-bottom: 2em;
}

.goal-content {
flex: 1;
padding: 1em;
}

.goal-image {
width: 50%;
height: 500px;
object-fit: cover;

}
.value-content {
    font-family: 'Dancing Script', cursive;
}

.value-content h2 {
    font-size: 32px; /* Điều chỉnh kích thước chữ ở đây */
}

.additional-section .value-image {
width: 50%; /* Điều chỉnh kích thước tối đa của hình ảnh */
height: 500px;
}

@media (max-width: 768px) {
            header {
                padding: 0.5em 0;
            }
            h1 {
                font-size: 24px;
            }
        }
            @media (max-width: 576px) {
            h1 {
                font-size: 20px;
            }
            p {
                font-size: 18px;
            }
            /* Các điều chỉnh khác cho các phần khác */
        }


</style>
<header>
    <h1>About Us</h1>
</header>
<main>

<section id="values">
    <section id="values">
        <div class="value">
            <div class="value-content">
                <h1 style="font-family:cursive; font-size: 70px;">Our Story</h1>
                <p style="font-size: 25px">"We are more than just a plant shop, we are a story born from passion and love for nature. It all began with our deep affection for the plant world and a desire to share that with everyone."
                    "We embarked on this journey with a simple goal: to bring nature into people's lives and create green spaces in every home and workplace. From small potted plants to large and rare specimens, we carefully select each plant to ensure quality and uniqueness."
                </p>
            </div>
            <img src="/images/hinh1.jpg" alt="Creativity" class="value-image">
        </div>
    </section>
</section>

<section id="goal" class="goal-section">
    <div class="value-content">
        <h1 style="font-family:cursive; font-size: 70px;">Our Values</h1>
        <br>
        <p style="font-size: 25px; margin-top: -20px;">Welcome to Tree One, your premier destination for [industry/niche] solutions. With a passion for innovation and a commitment to excellence, we've been serving [target audience] since [year]. Our mission is to [mission statement], and we take pride in [unique selling point]. Backed by a team of experts and a track record of success, we're dedicated to helping you [solve a problem or achieve a goal]. Discover the difference [Company Name] can make for you.</p>
    </div>
    <img src="/images/hinh2.jpg" alt="Our Goal" class="goal-image">
</section>

<section class="additional-section">
    <div class="value">
        <div class="value-content">
            <h1 style="font-family:cursive; font-size: 70px;">The uniqueness of our products</h1>
            <p style="font-size: 25px">We take pride in offering rare and distinctive plant species that bring a sense of individuality to your home and garden..</p>
        </div>
        <img src="/images/hinh3.jpg" alt="Additional Section" class="value-image">
    </div>
</section>
<section class="additional-section">
    <div class="value">
        <img src="/images/hinh4.jpg" alt="Section 4" class="value-image">
        <div class="value-content">
            <h1 style="font-family:cursive; font-size: 70px;">Commitment to quality</h1>
            <p style="font-size: 25px;">Quality is our top priority. We are committed to delivering the finest plants, along with detailed care information, to make nurturing your plants easier than ever..</p>
        </div>
    </div>
</section>
</main>
@endsection