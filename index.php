<? include_once 'secret.php' ?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	</head>
	<body>
		<div id="app">
			<form @submit.prevent="addMessage">
				<input type="text" class="form-control" v-model="message" name="message" placeholder="Type a message and press enter">
			</form>
			<ul class="list-group">
				<li class="list-group-item" v-for="message in messages">{{message}}</li>
			</ul>

		</div>

		<script
		  src="https://code.jquery.com/jquery-1.12.4.min.js"
		  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
		  crossorigin="anonymous"></script>
		<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
		<script src="https://unpkg.com/vue"></script>
		<script>
			var pusher = new Pusher('<?= APP_KEY ?>', {
			  cluster: '<?= APP_CLUSTER ?>'
			});
			var channel = pusher.subscribe('messaging');

			var app = new Vue({
			  el: '#app',
			  data: {
			    messages: [],
			    message: "",
			  },
			  mounted: function() {
					channel.bind('message', function(messages) {
					  app.messages = messages;
					});
			  },
			  methods: {
			  	addMessage: function() {
			  		this.messages.unshift(this.message);
			  		this.message="";
			  		$.post('messenger.php', {messages: this.messages});
			  	},
			  },
			});


		</script>
	</body>
</html>