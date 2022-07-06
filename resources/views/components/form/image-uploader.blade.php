<div class="col-sm-12 mb-3">
    <div class="upload-image-container card border-0" style="cursor: pointer;">
        <img class="card-img-top" src="{{{ $imageSrc ?? '/assets/img/no_image.png' }}}" alt="image-{{ $title }}">
        <div class="card-footer text-center">
            <h5><b>{{ $title }}</b></h5>
        </div>
    </div>
    <input type="file" name="{{ $name }}" accept="image/*" hidden>
</div>


@push('scripts')
<script>
    function initImageUploader() {
        $('.upload-image-container').on('dragover', function() {
            $('.upload-image-container').addClass('dragging')
        }).on('dragleave', function() {
            $('.upload-image-container').removeClass('dragging')
        }).on('drop', function(e) {
            $('.upload-image-container').removeClass('dragging hasImage');
            if (e.originalEvent) {
                var file = e.originalEvent.dataTransfer.files[0];
                if (file) {
                    var reader = new FileReader();
                    var container = $(e.currentTarget);
                    reader.readAsDataURL(file);
                    reader.onload = function(e) {
                        container.addClass('hasImage');
                        container.find('img').attr("src", reader.result)
                    }
                }

            }
        })
        $('.upload-image-container').on('click', function(e) {
            $(this).parent().find(':input').click()
        });
        window.addEventListener("dragover", function(e) {
            e = e || event;
            e.preventDefault();
        }, false);
        window.addEventListener("drop", function(e) {
            e = e || event;
            e.preventDefault();
        }, false);

        $('.upload-image-container').parent().find('input').change(function(e) {
            var input = e.target;
            if (input.files && input.files[0]) {
                var file = input.files[0];
                var container = $(this).parent().children('div.upload-image-container');

                var reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    container.addClass('hasImage');
                    container.find('img').attr("src", reader.result)
                }
            }
        })
    }

    $(function() {
        $('.upload-image-container').addClass('dragging').removeClass('dragging');
        initImageUploader();
    });
</script>
@endpush
