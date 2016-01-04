 <form>
		<script src="/sadmin/_inc/ckeditor/ckeditor.js"></script>
            <textarea name="htmlCode" id="editor1" rows="10" cols="80">
               <?php echo $newch[text];?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
        </form>