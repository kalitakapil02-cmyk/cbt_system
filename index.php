<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CBT System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: #242442;
    font-family: 'Segoe UI', sans-serif;
}

/* glass card */
.main-card{
    width:380px;
    padding:40px;
    border-radius:20px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    box-shadow: 0 0 30px rgba(0,0,0,0.4);
    text-align:center;
}

/* title */
.title{
    font-size:32px;
    font-weight:700;
    color:white;
}

/* subtitle */
.subtitle{
    color:#cbd5e1;
    margin-bottom:25px;
}

/* register button */
.btn-register{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    font-weight:600;
    color:white;
    background: linear-gradient(90deg,#7b2ff7,#3a86ff);
    transition:0.3s;
}

.btn-register:hover{
    transform:scale(1.05);
}

/* login button */
.btn-login{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    margin-top:15px;
    font-weight:600;
    color:white;
    background:#111;
    transition:0.3s;
}

.btn-login:hover{
    background:#0ac43c;
    transform:scale(1.05);
}

</style>
</head>

<body>

<div class="main-card">

    <h1 class="title">🎓 CBT System</h1>
    <p class="subtitle">Modern Online Examination Platform</p>

    <a href="register.php">
        <button class="btn-register">Register</button>
    </a>

    <a href="login.php">
        <button class="btn-login">Login</button>
    </a>

</div>

</body>
</html>