tinymce.init({
    selector: "textarea#pagetext",
    theme: "modern",
    document_base_url: $base_url,
    width: '100%',
    height: 400,
    image_advtab: true,
    relative_urls: false,
    content_css : $base_url+"css/editor.css",
    remove_script_host: false,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
   ],
   pagebreak_separator: "<!--pagebreak-->",
   external_filemanager_path:"filemanager/",
   filemanager_title:"Файл менежер" ,
   filemanager_access_key:"asd99sewsdf",
   external_plugins: { "filemanager" : $base_url+"filemanager/plugin.min.js"},
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | responsivefilemanager | link image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Green-Header-Theme', block: 'h2', classes: 'green-page-title'},
        {title: 'Twitter share', inline: 'span', classes: 'share-this-twitter'},
        {title: 'Responsive Image', selector: 'img', classes: 'img-responsive'},
        {title: 'Page title', block: 'h2', classes: 'h2-page-title'}
    ]
 }); 