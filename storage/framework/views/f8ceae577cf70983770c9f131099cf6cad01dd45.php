<!DOCTYPE html>
<html lang="en">
<?php
    $school = App\Models\School::all()->first();
    $stage = App\Models\Stage::where('active',true)->get()->first();
    $notices = App\Models\Notice::where('type','image')->get();
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo e($school?$school->name:'Sin Escuela'); ?></title>
	<meta name="description" content="Free open source Tailwind CSS starter template (Hero Product) to use with node.js/npm, postcss+purgecss!">
	<meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,hero, product">

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800" rel="stylesheet">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon-16x16.png">
	<link rel="stylesheet" href="https://unpkg.com/tailwindcss/dist/tailwind.min.css">
	<!--Replace with your tailwind.css once created-->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <style>
		.gradient {
			background: linear-gradient(90deg, #7f33d5 0%, #fff0cd 100%);
        }
	</style>

</head>


<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
	<!--Nav-->
	<nav id="header" class="fixed w-full z-30 top-0 text-white">


		<div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">

			<div class="toggleColour pl-4 flex items-center">
				<a class="text-white no-underline hover:no-underline font-bold inline-flex items-center justify-center text-2xl lg:text-4xl" href="#">
                    <!--Icon from: http://www.potlabicons.com/ -->
                    <?php if($school): ?>
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo" width="100px">
                    <?php endif; ?>
                    <span class="pl-5">
                        Telesis
                    </span>
				</a>
			</div>

			<div class="block lg:hidden pr-4">

			</div>


		</div>

		<hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
	</nav>
	<!--Hero-->
	<div class="pt-24">

		<div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
			<!--Left Col-->
            <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
                <?php if($school): ?>
                <p class="uppercase tracking-loose w-full mt-16">Bienvenido | <?php echo e($school->name); ?></p>
                <?php endif; ?>
                <h1 class="my-4 text-5xl font-bold leading-tight">Accede al Sistema de Control Escolar</h1>
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg">Inicio</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg">Iniciar sesión</a>
                    <?php endif; ?>
                <?php endif; ?>
			</div>
			<!--Right Col-->
			<div class="w-full md:w-3/5 py-6 text-center">
				<img class="w-full mt-16 md:w-4/5 z-50" src="<?php echo e(asset('images/landing.png')); ?>">
			</div>

		</div>

	</div>


	<div class="relative -mt-12 lg:-mt-24">
		<svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
					<path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
					<path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
					<path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
				</g>
				<g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
					<path d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"></path>
				</g>
			</g>
		</svg>
	</div>

	
	<section class="bg-white border-b py-8 noticias">
	
		<div class="container max-w-5xl mx-auto m-8">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Avisos y Convocatorias</h1>
        </div>
        <!-- carrousel de avisos -->
        <div class="carousel relative shadow-2xl bg-white max-w-4xl mx-auto rounded-lg">
		
            <div class="carousel-inner relative overflow-hidden w-full">
                <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--Slide 1-->
                    <input class="carousel-open" type="radio" id="carousel-<?php echo e($loop->index); ?>" name="carousel" aria-hidden="true" hidden="" <?php if($loop->first): ?> checked <?php endif; ?>">
                    <div class="carousel-item absolute opacity-0" style="height:50vh;">
                        <div class="image-bg-custom flex flex-col h-full h-100 w-full text-white lg:text-5xl sm:text-base text-center" style="background-image: url('/notices/<?php echo e($notice->uuid); ?>')" onclick="window.open('/notices/<?php echo e($notice->uuid); ?>','_blank')">
													<div class="card-title text-black px-1 py-16">

													</div>
													<div class="text-justify text-base lg:px-24 sm:px-20 md:py-16 bg-blur sm:py-5" style="flex-grow : 1;">
														<div class=" xl:text-xl sm:text-base text-center"><?php echo e($notice->title); ?></div>
															<br>
															<br>
															<p class="more">
																	<?php echo e($notice->body); ?>

															</p>
													</div>
                        </div>
                    </div>
                    <?php if($loop->first): ?>
                        <label for="carousel-<?php echo e($notices->count() - 1); ?>" class="prev control-<?php echo e($loop->index); ?> w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden opacity-75 text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                            </svg>
                        </label>
                    <?php else: ?>
                        <label for="carousel-<?php echo e($loop->index - 1); ?>" class="prev control-<?php echo e($loop->index); ?> w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden opacity-75 text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 left-0 my-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                            </svg>
                        </label>
                    <?php endif; ?>
                    <?php if($loop->last): ?>
                        <label for="carousel-0" class="next control-<?php echo e($loop->index); ?> w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden opacity-75 text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </label>
                    <?php else: ?>
                        <label for="carousel-<?php echo e($loop->index + 1); ?>" class="next control-<?php echo e($loop->index); ?> w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden opacity-75 text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-blue-700 leading-tight text-center z-10 inset-y-0 right-0 my-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </label>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($notices->count() < 1): ?>
                        <div class="text-center text-xl text-black">Sin Avisos o Convocatorias </div>
                <?php endif; ?>
                <!-- Add additional indicators for each slide-->
                <ol class="carousel-indicators">
                    <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="inline-block mr-3">
                            <label for="carousel-<?php echo e($loop->index); ?>" class="carousel-bullet cursor-pointer block text-4xl text-white hover:text-indigo-700">•</label>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
        </div>
        <style>
					.bg-blur{
						width: 100%;
						background: linear-gradient(90deg, #781ae4 0%, #ecbf56 100%);
						opacity: 0.8;
						border-radius: 20px 20px 0 0;
					}
					.more{
						overflow: hidden;
						text-overflow: ellipsis;
						height: 15em;
						max-height: 20em;
					}
					.image-bg-custom{
						background-repeat: no-repeat;
						background-size: cover;
						background-position: center center;
						overflow-y: hidden;
						cursor: pointer;
					}
					.carousel-open:checked + .carousel-item {
						position: static;
						opacity: 100;
					}
					.carousel-item {
						-webkit-transition: opacity 0.6s ease-out;
						transition: opacity 0.6s ease-out;
					}
					.carousel-indicators {
						list-style: none;
						margin: 0;
						padding: 0;
						position: absolute;
						bottom: 2%;
						left: 0;
						right: 0;
						text-align: center;
						z-index: 10;
					}
					@media  screen and (max-width: 700px){
						.more{
							margin-left: 10px;
							margin-right: 10px;
							height: 5em;
							max-height: 10em;
						}
					}
        </style>
        <?php
            echo '<style>';
            foreach($notices as $index=>$notice){
                echo "#carousel-{$index}:checked ~ .control-{$index},";
            }
            echo 'ayuwoki {
                display: block;
            }';
            foreach($notices as $index=>$notice){
                $child = $index+1;
                echo "#carousel-{$index}:checked ~ .control-{$index} ~ .carousel-indicators li:nth-child({$child}) .carousel-bullet,";
            }
            echo ' ayuwoki {
				color: #2b6cb0;
			}';
            echo '</style>';
        ?>
	</section>
	<!-- Change the colour #f8fafc to match the previous section colour -->
	<svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
			<g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
				<g class="wave" fill="#f8fafc">
					<path d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"></path>
				</g>
				<g transform="translate(1.000000, 15.000000)" fill="#FFFFFF">
					<g transform="translate(719.500000, 68.500000) rotate(-180.000000) translate(-719.500000, -68.500000) ">
						<path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
						<path d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z" opacity="0.100000001"></path>
						<path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" opacity="0.200000003"></path>
					</g>
				</g>
			</g>
		</g>
	</svg>
    
    <?php if($stage && $stage->slug == 'regist'): ?>
        <section class="container mx-auto text-center py-6 mb-12">

            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">¡ Inscribete !</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto bg-white w-1/6 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <h3 class="my-4 text-3xl leading-tight">¡ Pertenece a la mejor escuela ! , no lo pienses más</h3>
            <a href="mailto:<?php echo e($school->email); ?>?Subject=Necesito%20Informacion%20Sobre%20la%20telesecundaria" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg">Solicitar información</a>
        </section>
    <?php endif; ?>


	<!--Footer-->
	<footer class="bg-white">
		<div class="container mx-auto  px-8">
            <?php if($school): ?>
			<div class="w-full flex flex-col md:flex-row py-6">

				<div class="flex-1 mb-6 text-black">

					<a class="text-orange-600 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
						<!--Icon from: http://www.potlabicons.com/ -->
                        <img src="<?php echo e(\Storage::url($school->logo)); ?>" alt="logo" width="100px">
                        <br>
                        Telesis

					</a>
				</div>


				<div class="flex-1">
					<p class="uppercase text-gray-500 md:mb-6">Contacto</p>
					<ul class="list-reset mb-6">
						<li class="mt-2 inline-block mr-2 md:block md:mr-0">
							<a href="mailto:<?php echo e($school->email); ?>" class="no-underline hover:underline text-gray-800 hover:text-orange-500"><?php echo e($school->email); ?></a>
						</li>
						<li class="mt-2 inline-block mr-2 md:block md:mr-0">
							<a href="tel:<?php echo e($school->phone); ?>" class="no-underline hover:underline text-gray-800 hover:text-orange-500"><?php echo e($school->phone); ?></a>
						</li>
						<li class="mt-2 inline-block mr-2 md:block md:mr-0">
							<a href="#" class="no-underline hover:underline text-gray-800 hover:text-orange-500"><?php echo e($school->address); ?></a>
						</li>
					</ul>
				</div>
            </div>
            <?php endif; ?>
        </div>
        <?php if(session('message')): ?>
            <div class="fixed top-0 right-0 px-10 mt-6 mx-6 py-4 sm:py-5 rounded-lg pointer-events-auto z-10 bg-indigo-500" role="alert" x-data=" { show : false}"
             x-show="show" x-cloak>
            	<p class="font-bold">Mensaje del Sistema.</p>
                <?php echo e(session('message')); ?>

                <script>
                    show = true; setTimeout(() => show = false, 5000);
                </script>
            </div>
        <?php endif; ?>

	</footer>




	<!-- jQuery if you need it
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->
	<script>
		var scrollpos = window.scrollY;
		var header = document.getElementById("header");
		var navcontent = document.getElementById("nav-content");
		var navaction = document.getElementById("navAction");
		var brandname = document.getElementById("brandname");
		var toToggle = document.querySelectorAll(".toggleColour");

		document.addEventListener('scroll', function() {

			/*Apply classes for slide in bar*/
			scrollpos = window.scrollY;

			if (scrollpos > 10) {
				header.classList.add("bg-white");
				// navaction.classList.remove("bg-white");
				// navaction.classList.add("gradient");
				// navaction.classList.remove("text-gray-800");
				// navaction.classList.add("text-white");
				//Use to switch toggleColour colours
				for (var i = 0; i < toToggle.length; i++) {
					toToggle[i].classList.add("text-gray-800");
					toToggle[i].classList.remove("text-white");
				}
				header.classList.add("shadow");
				// navcontent.classList.remove("bg-gray-100");
				// navcontent.classList.add("bg-white");
			} else {
				header.classList.remove("bg-white");
				// navaction.classList.remove("gradient");
				// navaction.classList.add("bg-white");
				// navaction.classList.remove("text-white");
				// navaction.classList.add("text-gray-800");
				//Use to switch toggleColour colours
				for (var i = 0; i < toToggle.length; i++) {
					toToggle[i].classList.add("text-white");
					toToggle[i].classList.remove("text-gray-800");
				}

				header.classList.remove("shadow");
				// navcontent.classList.remove("bg-white");
				// navcontent.classList.add("bg-gray-100");

			}

		});
	</script>

	


</body>

</html>
<?php /**PATH D:\Proyectos-T\Telesis\resources\views/welcome.blade.php ENDPATH**/ ?>