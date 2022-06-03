<?php
/*
* Initialising metaboxes for post and pages
*/
if (is_admin()){
  /* 
   * prefix of meta keys, optional
   * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
   *  you also can make prefix empty to disable it
   * 
   */
  $prefix = 'quala_';
  /* 
   * configure your meta box
   */

  /* 
   * Homepage
  */
  // MainScreen----------------------------------------------------------
  $cfg_mainscreen = array(
    'id'              => 'quala_mainscreen',          // meta box id, unique per meta box
    'title'           => esc_html__('Mainscreen content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
  */
  $mainscreen =  new AT_Meta_Box($cfg_mainscreen);
  
  /*
   * Add fields to your meta box
  */
  //Image field
  $mainscreen->addImage($prefix.'main_image', array('name' => esc_html__('Mainscreen rotate image', 'quala')));
  //Text field
  $mainscreen->addText(
    $prefix.'hl_main_title',
    array(
      'name' => esc_html__('Hightlighted headline', 'quala'),
      'group' => 'start'
    )
  );
  //Text field
  $mainscreen->addText(
    $prefix.'main_title',
    array(
      'name' => esc_html__('Main headline', 'quala'),
      'group' => 'end'
    )
  );
  //Text field
  $mainscreen->addText(
    $prefix.'main_link_value',
    array(
      'name' => esc_html__('Link value', 'quala'),
      'desc' => esc_html__('If this is an internal link, enter the section id: "#section-id"', 'quala'),
      'group' => 'start'
    )
  );
  //Text field
  $mainscreen->addText(
    $prefix.'main_link_text',
    array(
      'name' => esc_html__('Link text', 'quala'),
      'group' => 'end'
    )
  );

  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $repeater_fields = array();
  //Text field
  $repeater_fields[] = $mainscreen->addText($prefix.'main_list_text', array( 'name' => esc_html__('List text', 'quala') ), true);
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $mainscreen->addRepeaterBlock($prefix.'re_main',array(
    'inline'   => false, 
    'name'     => 'Mainscreen list',
    'fields'   => $repeater_fields, 
    'sortable' => false
  ));

  /*
   * Don't Forget to Close up the meta box Declaration 
  */
  //Finish Meta Box Declaration 
  $mainscreen->Finish();



  // Intro----------------------------------------------------------
  $cfg_intro = array(
    'id'              => 'quala_intro',          // meta box id, unique per meta box
    'title'           => esc_html__('Introduction content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $intro =  new AT_Meta_Box($cfg_intro);

  //Text field
  $intro->addText(
    $prefix.'intro_title',
    array(
      'name' => esc_html__('Intro headline', 'quala'),
      'group' => 'start'
    )
  );
  //Text field
  $intro->addText(
    $prefix.'hl_intro_title',
    array(
      'name' => esc_html__('Hightlighted headline', 'quala'),
      'group' => 'end'
    )
  );
  //Textarea field
  $intro->addTextarea($prefix.'intro_left_text', array('name' => esc_html__('Introduction left text', 'intro')));
  //Textarea field
  $intro->addTextarea($prefix.'intro_right_text', array('name' => esc_html__('Introduction right text', 'intro')));
  //Textarea field
  $intro->addTextarea($prefix.'intro_bold_right_text', array('name' => esc_html__('Introduction bold right text', 'intro')));
  //Textarea field
  $intro->addTextarea($prefix.'intro_bot_text', array('name' => esc_html__('Introduction bottom text', 'intro')));
  //Text field
  $intro->addText(
    $prefix.'intro_link_value',
    array(
      'name' => esc_html__('Link value', 'quala'),
      'desc' => esc_html__('If this is an internal link, enter the section id: "#section-id"', 'quala'),
      'group' => 'start'
    )
  );
  //Text field
  $intro->addText(
    $prefix.'intro_link_text',
    array(
      'name' => esc_html__('Link text', 'quala'),
      'group' => 'end'
    )
  );

  //Finish Meta Box Declaration 
  $intro->Finish();




  // Clients----------------------------------------------------------
  $cfg_clients = array(
    'id'              => 'quala_clients',          // meta box id, unique per meta box
    'title'           => esc_html__('Clients content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $clients =  new AT_Meta_Box($cfg_clients);

  //Text field
  $clients->addText(
    $prefix.'clients_title', array( 'name' => esc_html__('Clients headline', 'quala') ) );
  //Image field
  $clients->addImage($prefix.'client_1', array('name' => esc_html__('Company 1', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_2', array('name' => esc_html__('Company 2', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_3', array('name' => esc_html__('Company 3', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_4', array('name' => esc_html__('Company 4', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_5', array('name' => esc_html__('Company 5', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_6', array('name' => esc_html__('Company 6', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_7', array('name' => esc_html__('Company 7', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_8', array('name' => esc_html__('Company 8', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_9', array('name' => esc_html__('Company 9', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_10', array('name' => esc_html__('Company 10', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_11', array('name' => esc_html__('Company 11', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_12', array('name' => esc_html__('Company 12', 'quala')));
  //Image field
  $clients->addImage($prefix.'client_13', array('name' => esc_html__('Company 13', 'quala')));

  //Finish Meta Box Declaration 
  $clients->Finish();




  // Steps----------------------------------------------------------
  $cfg_steps = array(
    'id'              => 'quala_steps',          // meta box id, unique per meta box
    'title'           => esc_html__('TL;DR content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $steps =  new AT_Meta_Box($cfg_steps);

  //Text field
  $steps->addText(
    $prefix.'steps_title', array( 'name' => esc_html__('TL;DR headline', 'quala') ) );
  //Text field
  $steps->addText(
    $prefix.'steps_1_title',
    array(
      'name' => esc_html__('Card 1 headline', 'quala'),
      'group' => 'start'
    )
  );
  //Textarea field
  $steps->addTextarea(
    $prefix.'steps_1_text',
    array(
      'name' => esc_html__('Card 1 text', 'quala'),
      'group' => 'end'
    )
  );
  //Text field
  $steps->addText(
    $prefix.'steps_2_title',
    array(
      'name' => esc_html__('Card 2 headline', 'quala'),
      'group' => 'start'
    )
  );
  //Textarea field
  $steps->addTextarea(
    $prefix.'steps_2_text',
    array(
      'name' => esc_html__('Card 2 text', 'quala'),
      'group' => 'end'
    )
  );
  //Text field
  $steps->addText(
    $prefix.'steps_3_title',
    array(
      'name' => esc_html__('Card 3 headline', 'quala'),
      'group' => 'start'
    )
  );
  //Textarea field
  $steps->addTextarea(
    $prefix.'steps_3_text',
    array(
      'name' => esc_html__('Card 3 text', 'quala'),
      'group' => 'end'
    )
  );
  //Text field
  $steps->addText(
    $prefix.'steps_4_title',
    array(
      'name' => esc_html__('Card 4 headline', 'quala'),
      'group' => 'start'
    )
  );
  //Textarea field
  $steps->addTextarea(
    $prefix.'steps_4_text',
    array(
      'name' => esc_html__('Card 4 text', 'quala'),
      'group' => 'end'
    )
  );
  //Image field
  $steps->addImage($prefix.'steps_footnote_img', array('name' => esc_html__('Footnote image', 'quala')));
  //Textarea field
  $steps->addTextarea($prefix.'steps_footnote_text', array('name' => esc_html__('Footnote text', 'intro')));
  //Text field
  $steps->addText(
    $prefix.'steps_link_value',
    array(
      'name' => esc_html__('Link value', 'quala'),
      'desc' => esc_html__('If this is an internal link, enter the section id: "#section-id"', 'quala'),
      'group' => 'start'
    )
  );
  //Text field
  $steps->addText(
    $prefix.'steps_link_text',
    array(
      'name' => esc_html__('Link text', 'quala'),
      'group' => 'end'
    )
  );

  //Finish Meta Box Declaration 
  $steps->Finish();



  // Features----------------------------------------------------------
  $cfg_features = array(
    'id'              => 'quala_features',          // meta box id, unique per meta box
    'title'           => esc_html__('Features content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $features =  new AT_Meta_Box($cfg_features);


  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $repeater_fields = array();
  //Image field
  $repeater_fields[] = $features->addImage($prefix.'features_card_img', array('name' => esc_html__('Card image', 'quala') ), true);
  //Text field
  $repeater_fields[] = $features->addText($prefix.'features_card_title', array( 'name' => esc_html__('Card title', 'quala') ), true);
  //Text field
  $repeater_fields[] = $features->addText($prefix.'features_card_subtitle', array( 'name' => esc_html__('Card subtitle', 'quala') ), true);
  //Textarea field
  $repeater_fields[] = $features->addTextarea($prefix.'features_card_text', array( 'name' => esc_html__('Card text', 'quala') ), true);
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $features->addRepeaterBlock($prefix.'re_features',array(
    'inline'   => false, 
    'name'     => 'Features cards',
    'fields'   => $repeater_fields, 
    'sortable' => false
  ));

  //Finish Meta Box Declaration 
  $features->Finish();



  // About----------------------------------------------------------
  $cfg_about = array(
    'id'              => 'quala_about',          // meta box id, unique per meta box
    'title'           => esc_html__('About us content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $about =  new AT_Meta_Box($cfg_about);

  //Text field
  $about->addText($prefix.'about_title', array( 'name' => esc_html__('About headline', 'quala') ));
  //Text field
  $about->addText(
    $prefix.'about_bold_text',
    array(
      'name' => esc_html__('About bold text', 'quala'),
      'group' => 'start'
    )
  );
  //Textarea field
  $about->addTextarea(
    $prefix.'about_text',
    array(
      'name' => esc_html__('About text', 'quala'),
      'group' => 'end'
    )
  );
  //Image field
  $about->addImage($prefix.'about_center_img', array('name' => esc_html__('Center image', 'quala')));
  //Image field
  $about->addImage($prefix.'about_side_img_1', array('name' => esc_html__('Side image 1', 'quala')));
  //Image field
  $about->addImage($prefix.'about_side_img_2', array('name' => esc_html__('Side image 2', 'quala')));
  //Image field
  $about->addImage($prefix.'about_side_img_3', array('name' => esc_html__('Side image 3', 'quala')));

  //Finish Meta Box Declaration 
  $about->Finish();



  // Team----------------------------------------------------------
  $cfg_team = array(
    'id'              => 'quala_team',          // meta box id, unique per meta box
    'title'           => esc_html__('Team content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $team =  new AT_Meta_Box($cfg_team);


  //Text field
  $team->addText($prefix.'team_title', array( 'name' => esc_html__('Team headline', 'quala') ));

  /*
   * To Create a reapeater Block first create an array of fields
   * use the same functions as above but add true as a last param
   */
  $repeater_fields = array();
  //Image field
  $repeater_fields[] = $team->addImage($prefix.'team_card_img', array('name' => esc_html__('Human image', 'quala') ), true);
  //Text field
  $repeater_fields[] = $team->addText($prefix.'team_card_name', array( 'name' => esc_html__('Human name', 'quala') ), true);
  //Text field
  $repeater_fields[] = $team->addText($prefix.'team_card_position', array( 'name' => esc_html__('Human position', 'quala') ), true);
  //Textarea field
  $repeater_fields[] = $team->addTextarea($prefix.'team_card_text', array( 'name' => esc_html__('Card text', 'quala') ), true);
  /*
   * Then just add the fields to the repeater block
   */
  //repeater block
  $team->addRepeaterBlock($prefix.'re_team',array(
    'inline'   => false, 
    'name'     => 'Team cards',
    'fields'   => $repeater_fields, 
    'sortable' => false
  ));

  //Finish Meta Box Declaration 
  $team->Finish();



  // Contacts----------------------------------------------------------
  $cfg_contacts = array(
    'id'              => 'quala_contacts',          // meta box id, unique per meta box
    'title'           => esc_html__('Contacts content', 'quala'),   // meta box title
    'pages'           => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'single'          => true,      // Display metaboxes on a specific page (false if diplayed at all)
    'page_name'       => 'template-homepage.php',  // if single = true. Name of page for which to output metaboxes
    'context'         => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'        => 'high',            // order of meta box: high (default), low; optional
    'fields'          => array(),            // list of meta fields (can be added by field arrays)
    'local_images'    => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme'  => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $contacts =  new AT_Meta_Box($cfg_contacts);

  //Text field
  $contacts->addText($prefix.'contacts_title', array( 'name' => esc_html__('Contacts headline', 'quala') ));
  //Text field
  $contacts->addText($prefix.'contacts_text', array(
      'name' => esc_html__('Pre-text of the link', 'quala') ));
  //Text field
  $contacts->addText($prefix.'contacts_main', array(
      'name' => esc_html__('E-mail', 'quala') ));

  //Finish Meta Box Declaration 
  $contacts->Finish();
}