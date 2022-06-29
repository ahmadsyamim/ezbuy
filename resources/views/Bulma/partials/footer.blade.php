        <footer class="footer">
            <div class="content has-text-centered">
                <p class="copyright text-center">&copy; {{ setting('site.title') }} @php echo date('Y'); @endphp. All rights reserved.</p>
            </div>
        </footer>
    </div> <!-- /.off-canvas-content -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    @stack('scripts')
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</body>
</html>
