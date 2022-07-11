<style type="text/css">

.mobileFrame{
	position: relative;
	overflow: hidden;
	width: 250px;
	height:500px;
	display:block;
	margin:0 auto 1rem;
	padding: 15px 17px;
	font-size: 1.2rem;
	-webkit-border-radius: 2rem;
	border-radius: 2rem;
	// width: 300px;
	// height:602px;
}
.mobileFrame .screen{
	z-index: 2;
	position: relative;
	height: 100%;
	width: 100%;
	overflow: hidden;
}
.mobileFrame iframe{
	height: 100%;
	width: 100%;
	overflow: hidden;
	border:none;
	border-radius: 2rem;
}
.mobileFrame p{
	padding: 0 1rem;
}
.mobileFrame:after{
	content: "";
	position: absolute;
	top:0;
	bottom: 0;
	left:0;
	right: 0;
	background: url('<?php echo \dash\url::cdn(); ?>/img/frame/iphone-x-1.png') no-repeat top center;
	background-size: 100%;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
	z-index: 3;
	transition: 0.3s;
}
[data-page='app'] .mobileFrame.play:hover:after{
	z-index: -1;
}

// splash Page design simulate
.mobileFrame[data-splash]{
	text-align: center;
}
.mobileFrame[data-splash] img{
	width: 50%;
	margin-top: 50%;
	margin-bottom: 10px;
}
.mobileFrame[data-splash] h2{
	font-weight: 900;
	font-size: 1.2rem;
	text-align: center;
	height: 40px;
	line-height: 40px;
	overflow: hidden;
	padding: 0 10px;
}
.mobileFrame[data-splash] h3{
	font-size: 1rem;
	font-weight: 700;
	height: 30px;
	text-align: center;
	line-height: 30px;
	overflow: hidden;
	padding: 0 10px;
}
.mobileFrame[data-splash] .desc{
	position: absolute;
	text-align: center;
	bottom: 50px;
	top: 360px;
	right: 20px;
	left: 20px;
	padding: 0 10px;
	max-height: 200px;
	line-height: 30px;
	font-weight: 400;
	overflow: hidden;
}
.mobileFrame[data-splash][data-color='red']{

}
.mobileFrame[data-splash][data-color='blue']{

}
.mobileFrame[data-splash][data-color='green']{

}
.mobileFrame[data-splash][data-color='yellow']{

}
.mobileFrame[data-splash][data-color='purple']{

}
.mobileFrame[data-splash][data-color='black']{

}

.mobileFrame[data-intro]{
	width: 200px;
	height:400px;
	text-align: center;
	background: linear-gradient(0deg, #A16BFE, #DEB0DF);
}
.mobileFrame[data-intro] .screen:before{
	content: "";
	position: absolute;
	width: 400px;
	height: 400px;
	border-radius: 50%;
	background-color: #fff;
	z-index: -1;
	bottom: -200px;
	left: -112px;
}
.mobileFrame[data-intro] .imgBox{
	width: 80%;
	border-radius: 1em;
	height: 50%;
	position: relative;
	background-color: #fff;
	margin: 20% auto 10%;
	box-shadow: 0 10px 30px #aaa;
}
.mobileFrame[data-intro] .imgBox:before{
	content: "";
	display: block;
	position: absolute;
	top: 0;
	left: 150px;
	width: 100%;
	border-radius: 1em;
	height: 100%;
	overflow: hidden;
	position: relative;
	background-color: #fff;
	box-shadow: 0 10px 30px #aaa;
}
.mobileFrame[data-intro] .imgBox:after{
	content: "";
	display: block;
	position: absolute;
	top: 0;
	right: 150px;
	width: 100%;
	border-radius: 1em;
	height: 100%;
	overflow: hidden;
	background-color: #fff;
	box-shadow: 0 10px 30px #aaa;
}
.mobileFrame[data-intro] img{
	display: block;
	width: 90%;
	margin: 10% auto 0;
	max-height: 90%;
	position: absolute;
	top: 0;
	right: 0;
	left: 0;
}
.mobileFrame[data-intro] h2{
	font-weight: 800;
	/*font-size: 1.4rem;*/
	line-height: 30px;
	overflow: hidden;
	padding: 0 10px;
}
.mobileFrame[data-intro] p{
	font-size: 0.8rem;
	line-height: 1.6rem;
	overflow: hidden;
	padding: 0 10px;
}
.mobileFrame[data-intro] nav{
	font-size: 1.2rem;
	line-height: 2rem;
	overflow: hidden;
	padding: 1rem 1.5rem;
	position: absolute;
	bottom: 0;
	right: 0;
	left: 0;
}
.mobileFrame[data-intro] nav .prev{
	color: #999;
	font-size: 10px;
}
.mobileFrame[data-intro] nav .next{
	color: #0b9ee4;
	font-weight: 700;
	font-size: 10px;
}
.mobileFrame[data-intro] nav .step i{
	display: inline-block;
	width: 5px;
	height: 3px;
	background-color: #0b9ee4;
	margin: 0 2px;
	border-radius: 1em;
	opacity: 0.5;
}
.mobileFrame[data-intro] nav .step i.current{
	width: 10px;
	opacity: 1;
}
// frame for apk page design
.mobileFrame[data-apk]{
	background-color: #c80a5a;
	background: linear-gradient(0deg, #c80a5a, #E13680);
	color: #fff;
}
.mobileFrame[data-apk] p{
	position: relative;
	top: 40%;
	text-align: center;
	font-size: 1.6rem;
	max-width: 60%;
	margin:0 auto;
	transition: 0.2s ease-in-out;
}
.mobileFrame[data-apk]:hover p{
	transform: scale(1.1);
}

</style>