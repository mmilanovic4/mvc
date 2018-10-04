	<footer>
		<p>
			<em>&copy; Miloš Milanović, <?= date('Y'); ?>.</em>
		</p>
	</footer>
	<!-- JavaScript -->
	<script src="<?= Utils::generateLink('assets/js/main.js'); ?>"></script>
	<?php if (isset($DATA['JAVASCRIPT_MODULE'])): ?>
	<script src="<?= Utils::generateLink($DATA['JAVASCRIPT_MODULE']); ?>"></script>
	<?php endif; ?>
</body>

</html>
