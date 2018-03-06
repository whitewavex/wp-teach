<?php if (comments_open()) { ?>
    <?php if (get_comments_number() == 0) { ?>
        <div class="comments main__comments">
<!--           <h3>Коментарів поки що немає, але Ви можете бути першим.</h3>-->
           <?php add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
                  
            function kama_reorder_comment_fields( $fields ){
                // die(print_r( $fields )); // посмотрим какие поля есть

                $new_fields = array(); // сюда соберем поля в новом порядке

                $myorder = array('author','email','url','comment'); // нужный порядок

                foreach( $myorder as $key ){
                    $new_fields[ $key ] = $fields[ $key ];
                    unset( $fields[ $key ] );
                }

                // если остались еще какие-то поля добавим их в конец
                if( $fields )
                    foreach( $fields as $key => $val )
                        $new_fields[ $key ] = $val;

                return $new_fields;
            } 
        ?>
       
        <?php comment_form(array(
            'title_reply' => 'Коментарів поки що немає, але Ви можете бути першим.',
            'title_reply_before' => '<h4 class="comments__header">',
            'title_reply_after' => '</h4>',
            'title_reply_to' => 'Відповісти на коментар %s',
            'comment_notes_before' => '<p class="comments__note">Ваша e-mail адреса не буде опублікована. Обов\'язкові поля відмічені *</p>',
            'class_form' => 'comments__form',
            'fields' => array(
                'author' => '<div class="row"><div class="col-lg-3 col-md-4 col-sm-8 col-9 offset-lg-1"><input type="text" id="author" name="author" class="comments__field" placeholder="Ваше ім\'я *" maxlength="30" autocomplete="on" tabindex="1"></div>',
                'email' => '<div class="col-lg-3 col-md-4 col-sm-8 col-9"><input type="email" id="email" name="email" class="comments__field" placeholder="Ваш e-mail *"></div>',
                'url' => '<div class="col-lg-3 col-md-4 col-sm-8 col-9"><input type="url" id="url" name="url" class="comments__field" placeholder="Адреса вашого сайту"></div></div>'),
            'comment_field' => '<div class="row"><div class="col-lg-9 offset-lg-1"><textarea id="comment" name="comment" cols="30" rows="10" class="comments__field comments__field_message" placeholder="Текст повідомлення... *"></textarea></div></div>',
            'submit_button' => '<div class="row"><div class="col-lg-3 col-md-4 col-sm-8 col-9 offset-lg-1"><input type="submit" class="button comments__field comments__field_sm" value="Відправити"></div></div>'
        )); ?>
        </div>
    <?php } else { ?>
    
    <div class="comments main__comments">
       
        <?php add_filter('comment_form_fields', 'kama_reorder_comment_fields' );
                  
            function kama_reorder_comment_fields( $fields ){
                // die(print_r( $fields )); // посмотрим какие поля есть

                $new_fields = array(); // сюда соберем поля в новом порядке

                $myorder = array('author','email','url','comment'); // нужный порядок

                foreach( $myorder as $key ){
                    $new_fields[ $key ] = $fields[ $key ];
                    unset( $fields[ $key ] );
                }

                // если остались еще какие-то поля добавим их в конец
                if( $fields )
                    foreach( $fields as $key => $val )
                        $new_fields[ $key ] = $val;

                return $new_fields;
            } 
        ?>
       
        <?php comment_form(array(
            'title_reply' => 'Залишити коментар',
            'title_reply_before' => '<h4 class="comments__header">',
            'title_reply_after' => '</h4>',
            'title_reply_to' => 'Відповісти на коментар %s',
            'comment_notes_before' => '<p class="comments__note">Ваша e-mail адреса не буде опублікована. Обов\'язкові поля відмічені *</p>',
            'class_form' => 'comments__form',
            'fields' => array(
                'author' => '<div class="row"><div class="col-lg-3 col-md-4 col-sm-8 col-9 offset-lg-1"><input type="text" id="author" name="author" class="comments__field" placeholder="Ваше ім\'я *" maxlength="30" autocomplete="on" tabindex="1"></div>',
                'email' => '<div class="col-lg-3 col-md-4 col-sm-8 col-9"><input type="email" id="email" name="email" class="comments__field" placeholder="Ваш e-mail *"></div>',
                'url' => '<div class="col-lg-3 col-md-4 col-sm-8 col-9"><input type="url" id="url" name="url" class="comments__field" placeholder="Адреса вашого сайту"></div></div>'),
            'comment_field' => '<div class="row"><div class="col-lg-9 offset-lg-1"><textarea id="comment" name="comment" cols="30" rows="10" class="comments__field comments__field_message" placeholder="Текст повідомлення... *"></textarea></div></div>',
            'submit_button' => '<div class="row"><div class="col-lg-3 col-md-4 col-sm-8 col-9 offset-lg-1"><input type="submit" class="button comments__field comments__field_sm" value="Відправити"></div></div>'
        )); ?>
        <h4 class="comments__title">Коментарі</h4>
        <div>
            <?php $args = array(
                'style' => 'div',
                'callback' => 'my_comments',
                'reply_text' => 'Відповісти',
                'avatar_size' => 64,
                'reverse_top_level' => true,
                'type' => 'comment'
            ); ?>
            <?php wp_list_comments( $args ); ?>
        </div>
    </div>
    
<?php } } else { ?>
    <h3>Обговорення заборонені для даного сторінки</h3>
<?php } ?>