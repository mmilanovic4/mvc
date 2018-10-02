	<footer>
		<p>
			<em>&copy; Miloš Milanović, <?php echo date('Y'); ?>.</em>
		</p>
	</footer>
	<!-- JavaScript -->
	<script src="<?php Utils::generateLink('assets/js/main.js'); ?>"></script>
	<?php if (isset($DATA['JAVASCRIPT_MODULE'])): ?>
	<script src="<?php Utils::generateLink($DATA['JAVASCRIPT_MODULE']); ?>"></script>
	<?php endif; ?>
</body>

</html>
