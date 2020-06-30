</main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-12 text-right">
                            <p class="mb-0">
                                &copy; 2020
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

	<!-- <script src="app.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/script.js') ?>"></script>
    <script type="text/javascript">
        $(function () {
            feather.replace();
            $("#table").dataTable({
            'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': ['nosort']
                }],
            "order": []
            });
        });
    </script>
</body>

</html>
