<?php $social_options = get_option('belon_theme_sect1_options'); ?>

<ul class="sc_icons">
 <?php echo $social_options['facebook'] ?
   '<li class="fb"><a href="' . $social_options['facebook'] . '" target="_blank" and rel="noopener noreferrer">
     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="transparent" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
       <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
     </svg>
   </a>
 </li>'
   : ''; ?>
 <?php echo $social_options['linkedin'] ?
   '<li class="in"><a href="' . $social_options['linkedin'] . '" target="_blank" and rel="noopener noreferrer">
     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="transparent" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
       <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
       <rect x="2" y="9" width="4" height="12"></rect>
       <circle cx="4" cy="4" r="2"></circle>
     </svg>
   </a></li>'
   : ''; ?>
 <?php echo $social_options['twitter'] ?
   '<li class="tw"><a href="' . $social_options['twitter'] . '" target="_blank" and rel="noopener noreferrer">
     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="transparent" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter">
       <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
       </path>
     </svg>
     </a></li>'
   : ''; ?>
</ul>