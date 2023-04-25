<?php 
// global $stub;
$count   = 1;
$access  = carbon_get_post_meta( $post->ID, 'token_inst_home' );
// $user_id = carbon_get_post_meta( $post->ID, 'user_id_inst_home' ); 
// $result  = instagram_api("https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $access);
$result  = instagram_api( 'https://graph.instagram.com/me/media?fields=id,media_url,permalink&access_token=' . $access );



// use InstagramScraper\Instagram;
// use Phpfastcache\Helper\Psr16Adapter;

// $instagram  = Instagram::withCredentials(new \GuzzleHttp\Client(), 'kyivstyle', 'kfgkfylbz2', new Psr16Adapter('Files'));
// $instagram->login();
// $instagram->saveSession();

// $posts  = $instagram->getFeed();

// $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
// $nonPrivateAccountMedias = $instagram->getMedias('kyivstyle');

?>

<!-- <pre><?php //print_r( $posts ); ?></pre>
<pre><?php //print_r( $nonPrivateAccountMedias ); ?></pre> -->

<div class="kyivstyle_wrap">
  <div class="container">
    <h2 class="kyivstyle_head"><?php echo carbon_get_post_meta( $post->ID, 'title_inst_home' ); ?></h2>
      <ul class="kyivstyle">
        
        <!-- <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-1" href="https://www.instagram.com/p/CL7TbBvlUs1/" target="_blank">
            <video width="320" height="240" controls>
              <source src="https://scontent.cdninstagram.com/o1/v/t16/f1/m82/F146823E54FFE6488EFE836004579A92_video_dashinit.mp4?efg=eyJ2ZW5jb2RlX3RhZyI6InZ0c192b2RfdXJsZ2VuLjcyMC5jbGlwcyJ9&_nc_ht=scontent.cdninstagram.com&_nc_cat=108&vs=527111738806639_411309821&_nc_vs=HBksFQIYT2lnX3hwdl9yZWVsc19wZXJtYW5lbnRfcHJvZC9GMTQ2ODIzRTU0RkZFNjQ4OEVGRTgzNjAwNDU3OUE5Ml92aWRlb19kYXNoaW5pdC5tcDQVAALIAQAVABgkR0tfZnFSSXRhSzRnMkI0REFIcTZqajJJVk84V2JxX0VBQUFGFQICyAEAKAAYABsBiAd1c2Vfb2lsATEVAAAmmJqX6Jvw3j8VAigCQzMsF0ArjU%2FfO2RaGBJkYXNoX2Jhc2VsaW5lXzFfdjERAHUAAA%3D%3D&ccb=9-4&oh=00_AfCfRWvHC8n0N8g1x24dNNSCK1x0S6Zo7m9Xt1Ufgb4SBA&oe=6442DE36&_nc_sid=ea0b6e&_nc_rid=9f4c94a220" type="video/mp4">
            </video>
          </a>
        </li> -->

        <!-- <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-1" href="https://www.instagram.com/p/CL7TbBvlUs1/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/154971853_473358997128576_1550262791581367240_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=100&_nc_ohc=Jx1r1tWAc98AX9S2eHW&oh=33d13928668dc83948ae855dcc6c7f10&oe=60676329" alt="instagram feed">
          </a>
        </li>

        <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-2" href="https://www.instagram.com/p/CL4wR_YFiHy/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/154110369_240355754459448_3314236674475356440_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=100&_nc_ohc=AZJHS7ixTokAX8pX-FD&oh=23ec69576f23e1521c9b3471fb7050b9&oe=60690623" alt="instagram feed">
          </a>
        </li>

        <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-3" href="https://www.instagram.com/p/CL2HIKilwGK/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/154436020_539844310661251_3112897800273236115_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=107&_nc_ohc=94_yo94xsE0AX8KUKnz&oh=c3394a72e65cda8e1ec4f7bb77222e31&oe=6068140F" alt="instagram feed">
          </a>
        </li>

        <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-4" href="https://www.instagram.com/p/CLzeCYslsB0/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/154348784_800443820546127_7235173876756640668_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=103&_nc_ohc=2jr2fz_QGfsAX_EhqDp&oh=738bd7f81154a2887d8d6a1c8cb601ab&oe=60682388" alt="instagram feed">
          </a>
        </li>

        <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-5" href="https://www.instagram.com/p/CLxFKzol0W-/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/154123535_177872853868881_4403008476205255493_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=109&_nc_ohc=wYZbxfFaGUgAX_SmlRI&oh=3f00161d253c051e64fc7727ab0e744c&oe=606A8444" alt="instagram feed">
          </a>
        </li>

        <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-6" href="https://www.instagram.com/p/CLubvedlIkV/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/153580708_1071480600043500_5968477670152765435_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=100&_nc_ohc=ah05_P63n8QAX9Nx0g4&oh=8b4486200106c1a8a3920949ef9a3e52&oe=6068759D" alt="instagram feed">
          </a>
        </li>

        <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-7" href="https://www.instagram.com/p/CLr0o0pFTsv/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/152874600_424470475484481_7916920853648778447_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=109&_nc_ohc=rNcGO-aAT2cAX8L9gh7&oh=452edc38c5f2cc487b7fd2f46fbbf522&oe=6067E475" alt="instagram feed">
          </a>
        </li>

        <li class="kyivstyle__item">
          <a class="kyivstyle__link" id="insta-8" href="https://www.instagram.com/p/CLpQj0LFzNq/" target="_blank">
            <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="https://instagram.fsev1-1.fna.fbcdn.net/v/t51.2885-15/sh0.08/e35/s640x640/152327751_788174005102510_1521731509991560532_n.jpg?tp=1&_nc_ht=instagram.fsev1-1.fna.fbcdn.net&_nc_cat=110&_nc_ohc=66QaLR3-eOoAX_TCwnv&oh=aef4583378767f62a8469c1a337828ae&oe=6069AE05" alt="instagram feed">
          </a>
        </li> -->
      
        <?php if ( $result->data ) : 

          foreach ( (array)$result->data as $data ): ?>

            <li class="kyivstyle__item">
              <a class="kyivstyle__link" id="insta-<?php echo $data->id; ?>" href="<?php echo $data->permalink; ?>" target="_blank">

                <?php if ( strpos($data->media_url, '.mp4') ) : ?>
                  <video controls>
                    <source src="<?php echo $data->media_url; ?>" type="video/mp4">
                  </video>
                <?php else : ?>
                  <img class="kyivstyle__img lazyload" src="<?php // echo $stub; ?>" data-src="<?php echo $data->media_url; ?>" alt="instagram feed">
                <?php endif; ?>

              </a>
            </li>

            <?php if ( $count == 8 ) break; 

            ++$count; 

          endforeach; 

        else:
          echo '<h2 class="kyivstyle_message">' . $result->error->message . '</h2>';
        endif; ?>

      </ul>
  </div>
</div>