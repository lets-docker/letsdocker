<?php /* Template Name: Create-Docker */ ?>

<?php get_header(); ?>
    
        <?php get_template_part('inc/sidebar', 'menu'); ?>

        </div>

        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                       
                        <a class="navbar-brand" href="#">Create Docker</a>
                    </div>
                    
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">

                    <div class="row">

                    

<div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">New Docker Project</h4>
                                   
                                </div>
                                <div class="card-content">
                                    <form>
                                       

                                      

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label">Project Name</label>
                                                    <input type="text" class="form-control project-name">
                                                <span class="material-input"></span></div>
                                            </div>
                                        </div> 

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="apps form-group label-floating is-empty">
                                                   
                                                    <?php
                        

                        $args = array( 'post_type' => 'letsdocker_apps', 'posts_per_page' => 1000 );
                        $loop = new WP_Query($args);
                        while ($loop->have_posts()) :
                            $loop->the_post();
                            
                             $post = get_post();

                            $image = get_field('icon');
                            $base = get_field('docker_base');
                            $category = get_field('category');
                        ?>
                        <div class="app-area col-lg-3 col-md-6 col-sm-6" data-appid="<?php echo $post->ID; ?>">

                       

                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <?php if (!empty($image)) : ?>

                                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" style="
                                        width: 50px;
                                        height: 50px;
                                    " />

                                        <?php endif; ?>
                                </div>
                                <div class="card-content">
                                    <p class="category" style="font-weight: bold;"><?php the_title(); ?></p>
                                  
                                </div>
                                <h3 class="title">&nbsp;</h3>
                                 <div class="card-footer">
                                    <div class="stats">
                                         <?php if (!empty($base)) : ?>

                                                <?php echo $base[0]->name;?>

                                        <?php else: ?>
                                            It's own base
                                        <?php endif; ?>



                                    </div>
                                </div>
                            </div>


                        
                        </div>

                        <?php endwhile; ?>
                                                <span class="material-input"></span></div>
                                            </div>
                                        </div>


                                      

                                        <button type="button" class="create-docker-button btn btn-primary pull-right">Create Docker<div class="ripple-container"></div></button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        </div>

                        <div class="result">
                            Total App : 0
                        </div>

                    
                        </div>
                        </div>

<script>

$('.app-area').on('click', function(){

    if($(this).hasClass("selected"))
    {
        $(this).removeClass("selected");
        deselectApp($(this));

    }else{

        $(this).addClass("selected");
        selectApp($(this));

    }

    updateResult()

});

function selectApp(object)
{

    object.children('.card').css('background', '#9AFE2E');
    object.find('.category').css('color', '#000');
    object.find('.stats').css('color', '#000');
    
}

function deselectApp(object)
{

    object.children('.card').css('background', '#fff');
    object.find('.category').css('color', '#999999');
    object.find('.stats').css('color', '#999999');
}

function updateResult()
{

    var count = $('.apps').find(".selected").length;

    $('.result').html("Total App : " + count);

}

$('.create-docker-button').on('click', function(){

    var apps = $('.apps').find(".selected");

    var ids = [];

    apps.each(function( index ) {
      ids.push($(this).data("appid"));
    });

   $.post( "<?php echo admin_url('/admin-ajax.php')?>", {action:"create_docker", apps : ids, project_name: $('.project-name').val() },function( data ) {
      $( ".result" ).html( data );
    });

});


</script>


                        <?php get_footer(); ?>