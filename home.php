<?php
$healthQuotes = [
    "<p>Health is the greatest gift, contentment the greatest wealth, faithfulness the best relationship.</p> <span class='quoted'>- Buddha</span>",
    "<p>No matter how much it gets abused, the body can restore balance. The first rule is to stop interfering with nature.</p> <span class='quoted'>- Deepak Chopra</span>",
    "<p>He who has health has hope; and he who has hope, has everything.</p> <span class='quoted'>- Thomas Carlyle</span>",
    "<p>Give a man health and a course to steer, and he’ll never stop to trouble about whether he’s happy or not.</p> <span class='quoted'>- George Bernard Shaw</span>",
    "<p>Health is a state of complete harmony of the body, mind, and spirit.</p> <span class='quoted'>- B.K.S. Iyengar</span>",
    "<p>We are what we repeatedly do. Excellence, then, is not an act, but a habit.</p> <span class='quoted'>- Will Durant</span>",
    "<p>Values are related to our emotions, just as we practice physical hygiene to preserve our physical health, we need to observe emotional hygiene to preserve a healthy mind and attitudes.</p> <span class='quoted'>- Dalai Lama</span>",
    "<p>Take care of your body. It's the only place you have to live in.</p> <span class='quoted'>- Jim Rohn</span>",
    "<p>It is health that is real wealth and not pieces of gold and silver.</p> <span class='quoted'>- Mahatma Gandhi</span>",
    "<p>Early to bed and early to rise makes a man healthy, wealthy, and wise.</p> <span class='quoted'>- Benjamin Franklin</span>",
    "<p>Nurturing yourself is not selfish – it’s essential to your survival and your well-being.</p> <span class='quoted'>- Renee Peterson Trudeau</span>",
    "<p>The human body is the best picture of the human soul.</p> <span class='quoted'>- Tony Robbins</span>",
    "<p>Eat healthily, sleep well, breathe deeply, move harmoniously.</p> <span class='quoted'>- Jean-Pierre Barral</span>",
    "<p>We know that food is a medicine, perhaps the most powerful drug on the planet with the power to cause or cure most disease.</p> <span class='quoted'>- Dr. Mark Hyman</span>",
    "<p>If you truly treat your body like a temple, it will serve you well for decades. If you abuse it, you must be prepared for poor health and a lack of energy.</p> <span class='quoted'>- Oli Hille</span>"
];




// select a random quote
$randomQuote = $healthQuotes[array_rand($healthQuotes)];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

</head>
<body>
        
    <?php include __Dir__."/Template/Header.php"?>
    <div class="s_cont container">
        <h1 class="welc">Welcome,<br><?=$receptionist_name; ?>!</h1>
        <form action="search.php" method="get" class="homeform" >   
            <input type="hidden" name="choice" value="name">
            <input type="text" name="get_patient" placeholder="Please Enter patient's Name...">
            <input type="submit" name="homesrch" id="search" value="Search">
        </form>
        <div class="qbox">
        <img src="css/doc.jpeg" alt="">
        <div class="quote">
            <?= $randomQuote;?>
        </div>
        </div>


    </div>
    <?php include "Template/footer.php"?>

</body>
</html>

<style>
    form,header,footer,.qbox{
        opacity: 0;
        animation: welcome 2s forwards; 
    }
    
    h1{
        opacity:100%;
        text-align:center;
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        animation: welcometxt 1s forwards;
    }
    
    @keyframes welcome {
        25% {opacity : 0;}
        100%{opacity: 100%;}   
    }

    @keyframes welcometxt {
        0%{opacity: 100%;}   
        100%{opacity: 0%;}   
    }


</style>