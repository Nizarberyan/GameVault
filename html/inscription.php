<?php 
include_once 'header.php';
?>
<div class="sign_in dd">
    <h2>Welcome Back please sign in </h2>
<form action="#" method="post">
    <input type="email" name="email" placeholder="Ente your email">
    <input type="password" name="pwd" placeholder="Enter your password">
    <div class="switch_to_sign_up"><button class="sign_up_btn">Sign in</button>
    <p>Don't have an account? <a href="#">sign up</a></p>
    </div>
    </form>
</div>
    
<div class="sign_up">
    <h2>Welcome to our Site please sign up </h2>
<form action="#" method="post">
    <input type="text" name="user" placeholder="Ente your Name">
    <input type="email" name="email" placeholder="Ente your email">
    <input type="password" name="pwd" placeholder="Enter a password">
    <input type="password" name="conf_pwd" placeholder="Confirme your password">
    <div class="switch_to_sign_in"><button class="sign_up_btn">Sign Up</button>
    <p>alredy have an account? <a href="#">sign in</a></p>
    </div>
    </form>
</div>
<?php 
include_once 'footer.php';
?>

<script>
const  sign_in=document.querySelector('.sign_in')
const  sign_up=document.querySelector('.sign_up')
const  sign_up_btn=document.querySelector('.sign_up_btn')

sign_up_btn.addEventListener



</script>