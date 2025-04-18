(function($){"use strict";var $wrapper=$('.main-wrapper');var $pageWrapper=$('.page-wrapper');var $slimScrolls=$('.slimscroll');var Sidemenu=function(){this.$menuItem=$('#sidebar-menu a');};function init(){var $this=Sidemenu;$('#sidebar-menu a').on('click',function(e){if($(this).parent().hasClass('submenu')){e.preventDefault();}
if(!$(this).hasClass('subdrop')){$('ul',$(this).parents('ul:first')).slideUp(350);$('a',$(this).parents('ul:first')).removeClass('subdrop');$(this).next('ul').slideDown(350);$(this).addClass('subdrop');}else if($(this).hasClass('subdrop')){$(this).removeClass('subdrop');$(this).next('ul').slideUp(350);}});$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');}
init();$('body').append('<div class="sidebar-overlay"></div>');$(document).on('click','#mobile_btn',function(){$wrapper.toggleClass('slide-nav');$('.sidebar-overlay').toggleClass('opened');$('html').addClass('menu-opened');return false;});$(".sidebar-overlay").on("click",function(){$wrapper.removeClass('slide-nav');$(".sidebar-overlay").removeClass("opened");$('html').removeClass('menu-opened');});if($('.page-wrapper').length>0){var height=$(window).height();$(".page-wrapper").css("min-height",height);}
$(window).resize(function(){if($('.page-wrapper').length>0){var height=$(window).height();$(".page-wrapper").css("min-height",height);}});if($('.select').length>0){$('.select').select2({minimumResultsForSearch:-1,width:'100%'});}
if($('.datetimepicker').length>0){$('.datetimepicker').datetimepicker({format:'DD/MM/YYYY',icons:{up:"fa fa-angle-up",down:"fa fa-angle-down",next:'fa fa-angle-right',previous:'fa fa-angle-left'}});$('.datetimepicker').on('dp.show',function(){$(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');}).on('dp.hide',function(){$(this).closest('.temp').addClass('table-responsive').removeClass('temp')});}
if($('[data-toggle="tooltip"]').length>0){$('[data-toggle="tooltip"]').tooltip();}
if($('.datatable').length>0){$('.datatable').DataTable({"bFilter":false,});}
if($('.clickable-row').length>0){$(document).on('click','.clickable-row',function(){window.location=$(this).data("href");});}
$(document).on('click','#check_all',function(){$('.checkmail').click();return false;});if($('.checkmail').length>0){$('.checkmail').each(function(){$(this).on('click',function(){if($(this).closest('tr').hasClass('checked')){$(this).closest('tr').removeClass('checked');}else{$(this).closest('tr').addClass('checked');}});});}
$(document).on('click','.mail-important',function(){$(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');});if($('.summernote').length>0){$('.summernote').summernote({height:200,minHeight:null,maxHeight:null,focus:false});}
if($('.proimage-thumb li a').length>0){var full_image=$(this).attr("href");$(".proimage-thumb li a").click(function(){full_image=$(this).attr("href");$(".pro-image img").attr("src",full_image);$(".pro-image img").parent().attr("href",full_image);return false;});}
if($('#pro_popup').length>0){$('#pro_popup').lightGallery({thumbnail:true,selector:'a'});}
if($slimScrolls.length>0){$slimScrolls.slimScroll({height:'auto',width:'100%',position:'right',size:'7px',color:'#ccc',allowPageScroll:false,wheelStep:10,touchScrollStep:100});var wHeight=$(window).height()-60;$slimScrolls.height(wHeight);$('.sidebar .slimScrollDiv').height(wHeight);$(window).resize(function(){var rHeight=$(window).height()-60;$slimScrolls.height(rHeight);$('.sidebar .slimScrollDiv').height(rHeight);});}
$(document).on('click','#toggle_btn',function(){if($('body').hasClass('mini-sidebar')){$('body').removeClass('mini-sidebar');$('.subdrop + ul').slideDown();}else{$('body').addClass('mini-sidebar');$('.subdrop + ul').slideUp();}
setTimeout(function(){mA.redraw();mL.redraw();},300);return false;});$(document).on('mouseover',function(e){e.stopPropagation();if($('body').hasClass('mini-sidebar')&&$('#toggle_btn').is(':visible')){var targ=$(e.target).closest('.sidebar').length;if(targ){$('body').addClass('expand-menu');$('.subdrop + ul').slideDown();}else{$('body').removeClass('expand-menu');$('.subdrop + ul').slideUp();}
return false;}});})(jQuery);
function displaySelectedFiles() {
    const fileInput = document.getElementById('hotelImage');
    const label = document.querySelector('.custom-file-label');
    
    if (fileInput.files.length > 0) {
        let filesList = '';
        for (let i = 0; i < fileInput.files.length; i++) {
            filesList += fileInput.files[i].name;
            if (i !== fileInput.files.length - 1) {
                filesList += ', ';
            }
        }
        label.innerText = filesList;
    } else {
        label.innerText = 'Choose file';
    }
}

function getHotelInfo() {
    var hotelID = document.getElementById('hotelID').value;

    // Make an AJAX request to get hotel information
    fetch('/get-hotel-info/' + hotelID, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Populate the input fields with retrieved data
        document.getElementById('hotelName').value = data.hotelName; // Update to data.hotelName
        document.getElementById('numberOfRooms').value = data.numberOfRooms; // Update to data.numberOfRooms
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle error scenario, such as displaying an error message
    });
}
// Xử lý sự kiện khi người dùng click để xóa khách sạn
function deleteHotel(hotelId) {
    $.ajax({
        url: '{{ route("Delete-Hotels") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            HotelID: hotelId
        },
        success: function(response) {
            if (response.success) {
                alert('Xóa thành công');
                location.reload();
            } else {
                alert('Không thể xóa khách sạn. Vui lòng thử lại sau.');
            }
        },
        error: function(xhr, status, error) {
            alert('Lỗi: ' + error);
        }
    });
}

$('.delete-hotel-btn').on('click', function() {
    var hotelId = $(this).data('HotelID');
    deleteHotel(hotelId);
});

function getBookingInfo() {
    var user_id = document.getElementById('user_id').value;

    fetch('/get-booking-info/' + user_id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('username').value = data.username;
        document.getElementById('useremail').value = data.useremail;
    })
    .catch(error => {
        console.error('Error:', error);

    });
}

    $(document).ready(function () {
        $('#HotelName').change(function () {
            var hotelName = $(this).val();

            // Gửi yêu cầu Ajax để lấy danh sách loại phòng tương ứng với khách sạn đã chọn
            $.ajax({
                url: '/getRoomTypes', // Thay đổi đường dẫn tùy thuộc vào cấu hình của bạn
                type: 'POST',
                data: {hotelName: hotelName},
                success: function (data) {
                    // Xóa tất cả các option hiện tại trong select "room_type"
                    $('#room_type').empty();

                    // Thêm option mới từ dữ liệu nhận được từ máy chủ
                    $.each(data, function (key, value) {
                        $('#room_type').append('<option value="' + value + '">' + value + '</option>');
                    });
                }
            });
        });
    });
    $('#HotelName').change(function() {
        var selectedHotel = $(this).val();
    
        $.ajax({
            url: '{{ route("getRoomTypes") }}',
            method: 'GET',
            data: { hotelName: selectedHotel },
            success: function(response) {
                var roomTypes = response;
                $('#room_type').empty();
                $.each(roomTypes, function(key, value) {
                    $('#room_type').append('<option value="' + value + '">' + value + '</option>');
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });


