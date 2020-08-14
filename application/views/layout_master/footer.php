                    </div>
                <!-- begin:: Footer -->
                <div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
                    <div class="kt-container  kt-container--fluid ">
                        <div class="kt-footer__copyright">
                            2020&nbsp;&copy;&nbsp;<a href="#!" target="_blank" class="kt-link">Keenthemes</a>
                        </div>
                        <div class="kt-footer__menu">
                            <a href="#!" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                            <a href="#!" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                            <a href="#!" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#22b9ff",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
        $('#bookingadminli').on('click', function(){
            if($(this).hasClass('kt-menu__item--open-dropdown kt-menu__item--hover')){
                $(this).removeClass('kt-menu__item--open-dropdown kt-menu__item--hover');
            }else{
                $(this).addClass('kt-menu__item  kt-menu__item--submenu kt-menu__item--here kt-menu__item--open-dropdown kt-menu__item--hover');
            }
        })
    </script>
    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') ?>" type="text/javascript"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
    <script src="<?= base_url('assets/plugins/custom/gmaps/gmaps.js') ?>" type="text/javascript"></script>
    <!-- datatable -->
    <script src="<?= base_url('assets/plugins/custom/datatables/datatables.bundle.js') ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/js/pages/crud/datatables/basic/basic.js') ?>" type="text/javascript"></script>
</body>
</html>
