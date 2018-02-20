</div>
</div>

<footer class="page-footer blue center-on-small-only">

    <!--Footer Links-->
    <!-- <div class="container-fluid">
        <div class="row"> -->

            <!--First column-->
            <!-- <div class="col-md-6">
                <h5 class="title">Footer Content</h5>
                <p>Here you can use rows and columns here to organize your footer content.</p>
            </div> -->
            <!--/.First column-->

            <!--Second column-->
            <!-- <div class="col-md-6">
                <h5 class="title">Links</h5>
                <ul>
                    <li><a href="#!">Link 1</a></li>
                    <li><a href="#!">Link 2</a></li>
                    <li><a href="#!">Link 3</a></li>
                    <li><a href="#!">Link 4</a></li>
                </ul>
            </div>
            <!--/.Second column-->
        <!-- </div>
    </div>  -->
    <!--/.Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            © <?php echo date("Y"); ?> Copyright: <a href="#"> Paweł Ciarka & Mateusz Pylak </a>

        </div>
    </div>
    <!--/.Copyright-->

</footer>

<style media="screen">
footer.page-footer .footer-copyright {
  overflow: hidden;
  height: 50px;
  line-height: 50px;
  color: #868e96 !important;
  font-weight: bold;
  background-color: #f7f7f7;
  text-align: center;
  font-size: .9rem;
}
</style>
<!-- footer -->



<!-- /CONTENT -->

 <!-- Optional JavaScript -->
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://unpkg.com/popper.js@1.12.5/dist/umd/popper.js" integrity="sha384-KlVcf2tswD0JOTQnzU4uwqXcbAy57PvV48YUiLjqpk/MJ2wExQhg9tuozn5A1iVw" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.0.0-beta.3/dist/js/bootstrap-material-design.js" integrity="sha384-hC7RwS0Uz+TOt6rNG8GX0xYCJ2EydZt1HeElNwQqW+3udRol4XwyBfISrNDgQcGA" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {

  $('body').bootstrapMaterialDesign();

  $('.transfer').on("click", function(){

   //  console.log(this.id);
     window.location.href = "transfer-info.php?id="+this.id;
  });

});

</script>
</body>
</html>
