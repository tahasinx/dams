<title>PROJECT-DAMS</title>
<meta name="author" content="Nile-Theme">
<meta name="robots" content="index follow">
<meta name="googlebot" content="index follow">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta name="keywords" content="directory, doctor, doctor directory, Health directory, listing, map, medical, medical directory, professional directory, reservation, reviews">
<meta name="description" content="Health Care & Medical Services Directory">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/x-icon" href="assets/img/c1.jpg">
<!-- google fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800%7Chttps://fonts.googleapis.com/css?family=Open+Sans:400,600,800%7CPoppins:300i,300,400,700,400i,500%7CDancing+Script:700%7CDancing+Script:700" rel="stylesheet">
<!-- animate -->
<link rel="stylesheet" href="assets/css/animate.css" />
<!-- owl Carousel assets -->
<link href="assets/css/owl.carousel.css" rel="stylesheet">
<link href="assets/css/owl.theme.css" rel="stylesheet">
<!-- bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<!-- hover anmation -->
<link rel="stylesheet" href="assets/css/hover-min.css">
<!-- flag icon -->
<link rel="stylesheet" href="assets/css/flag-icon.min.css">
<!-- main style -->
<link rel="stylesheet" href="assets/css/style.css">
<!-- colors -->
<link rel="stylesheet" href="assets/css/colors/main.css">
<!-- elegant icon -->
<link rel="stylesheet" href="assets/css/elegant_icon.css">
<link rel="stylesheet" href="assets/css/font-awesome-animation.min.css">

<!--fonts-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
<!-- jquery library  -->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<!-- fontawesome  -->
<script defer src="../../../use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<style>
    html {
        overflow: scroll;
        overflow-x: hidden;
    }
    ::-webkit-scrollbar {
        width: 0px;  /* Remove scrollbar space */
        background: transparent;  /* Optional: just make scrollbar invisible */
    }
    /* Optional: show position indicator in red */
    ::-webkit-scrollbar-thumb {
        background: #FF0000;
    }

    .awesome-modal {
        display: none;
        background-color: whitesmoke;
        box-shadow: 0 0 26px 0 rgba(0, 0, 0, 0.2);
        border-radius: 4px;
        padding: 1rem;
        width: 450px;
        min-height:150px;
        max-width: 80%;
        position: fixed;
        top: 50%;
        left: 50%;
        -webkit-transform: translate3d(-50%, -50%, 0);
        transform: translate3d(-50%, -50%, 0);
        overflow: hidden;
        z-index: 999;
        -webkit-animation: bounce .4s ease forwards;
        animation: bounce .4s ease forwards;
        font-family: 'Titillium Web', sans-serif;
    }
    .awesome-modal * {
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .awesome-overlay {
        display: none;
        background-color: rgba(0, 0, 0, 0.6);
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 998;
        overflow: hidden;
        cursor: default;
    }
    .close-icon {
        position: absolute;
        width: 1rem;
        height: 1rem;
        top: .7rem;
        right: .7rem;
        -webkit-transition: opacity .2s ease;
        transition: opacity .2s ease;
    }
    .close-icon::before, .close-icon::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: inherit;
        height: 2px;
        background-color: #999;
    }
    .close-icon::before {
        -webkit-transform: translate(-50%, -50%) rotate(45deg);
        transform: translate(-50%, -50%) rotate(45deg);
    }
    .close-icon::after {
        -webkit-transform: translate(-50%, -50%) rotate(135deg);
        transform: translate(-50%, -50%) rotate(135deg);
    }

    .modal-title {
        margin-top: 0;
        text-transform: none;
    }

    :target {
        display: block;
    }
    :target ~ .awesome-overlay {
        display: block;
    }

    @-webkit-keyframes bounce {
        0% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(0.7);
            transform: translate3d(-50%, -50%, 0) scale(0.7);
        }
        45% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(1.05);
            transform: translate3d(-50%, -50%, 0) scale(1.05);
        }
        80% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(0.95);
            transform: translate3d(-50%, -50%, 0) scale(0.95);
        }
        100% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(1);
            transform: translate3d(-50%, -50%, 0) scale(1);
        }
    }

    @keyframes bounce {
        0% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(0.7);
            transform: translate3d(-50%, -50%, 0) scale(0.7);
        }
        45% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(1.05);
            transform: translate3d(-50%, -50%, 0) scale(1.05);
        }
        80% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(0.95);
            transform: translate3d(-50%, -50%, 0) scale(0.95);
        }
        100% {
            -webkit-transform: translate3d(-50%, -50%, 0) scale(1);
            transform: translate3d(-50%, -50%, 0) scale(1);
        }
    }
    #close {
        position: fixed;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    
    .content{
        font-family: 'Titillium Web', sans-serif;
    }

    /* BELL */

    @-webkit-keyframes ring {
        0% {
            -webkit-transform: rotate(-15deg);
            transform: rotate(-15deg);
        }

        2% {
            -webkit-transform: rotate(15deg);
            transform: rotate(15deg);
        }

        4% {
            -webkit-transform: rotate(-18deg);
            transform: rotate(-18deg);
        }

        6% {
            -webkit-transform: rotate(18deg);
            transform: rotate(18deg);
        }

        8% {
            -webkit-transform: rotate(-22deg);
            transform: rotate(-22deg);
        }

        10% {
            -webkit-transform: rotate(22deg);
            transform: rotate(22deg);
        }

        12% {
            -webkit-transform: rotate(-18deg);
            transform: rotate(-18deg);
        }

        14% {
            -webkit-transform: rotate(18deg);
            transform: rotate(18deg);
        }

        16% {
            -webkit-transform: rotate(-12deg);
            transform: rotate(-12deg);
        }

        18% {
            -webkit-transform: rotate(12deg);
            transform: rotate(12deg);
        }

        20% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
    }

    @keyframes ring {
        0% {
            -webkit-transform: rotate(-15deg);
            -ms-transform: rotate(-15deg);
            transform: rotate(-15deg);
        }

        2% {
            -webkit-transform: rotate(15deg);
            -ms-transform: rotate(15deg);
            transform: rotate(15deg);
        }

        4% {
            -webkit-transform: rotate(-18deg);
            -ms-transform: rotate(-18deg);
            transform: rotate(-18deg);
        }

        6% {
            -webkit-transform: rotate(18deg);
            -ms-transform: rotate(18deg);
            transform: rotate(18deg);
        }

        8% {
            -webkit-transform: rotate(-22deg);
            -ms-transform: rotate(-22deg);
            transform: rotate(-22deg);
        }

        10% {
            -webkit-transform: rotate(22deg);
            -ms-transform: rotate(22deg);
            transform: rotate(22deg);
        }

        12% {
            -webkit-transform: rotate(-18deg);
            -ms-transform: rotate(-18deg);
            transform: rotate(-18deg);
        }

        14% {
            -webkit-transform: rotate(18deg);
            -ms-transform: rotate(18deg);
            transform: rotate(18deg);
        }

        16% {
            -webkit-transform: rotate(-12deg);
            -ms-transform: rotate(-12deg);
            transform: rotate(-12deg);
        }

        18% {
            -webkit-transform: rotate(12deg);
            -ms-transform: rotate(12deg);
            transform: rotate(12deg);
        }

        20% {
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
    }

    .faa-ring.animated,
    .faa-ring.animated-hover:hover,
    .faa-parent.animated-hover:hover > .faa-ring {
        -webkit-animation: ring 2s ease infinite;
        animation: ring 2s ease infinite;
        transform-origin-x: 50%;
        transform-origin-y: 0px;
        transform-origin-z: initial;
    }

    #header_under{
        display: none;
        width: 300px;
        height: 150px;
        background: red
    }
    .show:hover ~ #header_under{
        display: block;
    }
</style>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>