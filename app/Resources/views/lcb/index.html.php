

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

	<script type="text/javascript">



		$(document).ready(function(){


			$('#ajax_click_DELETE_article').on('click', function(event){

				if (!confirm("Click OK if you are sure")) {return false;}

				var article_id = $("#article_id").val();

				$.ajax({
				 url:"delete_article",
				 method:"POST",
				 data:{name_func: 'delete_article', article_id: article_id},
				 success:function(response_json)
				 {
					 alert('Success deleted');
				 }
				});
			});



      $('#ajax_click_DELETE_comment').on('click', function(event){

				if (!confirm("Click OK if you are sure")) {return false;}

				var comment_id = $("#comment_id").val();

				$.ajax({
				 url:"delete_comment",
				 method:"POST",
				 data:{name_func: 'delete_comment', comment_id: comment_id},
				 success:function(response_json)
				 {
					 alert('Success deleted');
				 }
				});
			});




			$('#ajax_click_DELETE_categorie').on('click', function(event){

				if (!confirm("Click OK if you are sure")) {return false;}

				var categorie_id = $("#categorie_id").val();

				$.ajax({
				 url:"delete_categorie",
				 method:"POST",
				 data:{name_func: 'delete_categorie', categorie_id: categorie_id},
				 success:function(response_json)
				 {
					 alert('Success deleted');
				 }
				});
			});



		});
	</script>

















<a href='http://localhost/xxx2/web/app_dev.php/index'> REFRESH PAGE</a>

<h2> MESSAGES:  </h2>
<?php
  echo $message;
  //unset($_SESSION['user_id']);
?>

<br/><br/><hr/><br><br/>


<h2> 1. Registration</h2>
  <form action='create_user' method='POST'>
		name: <input type='text' name='tbName' /> <br/>
		pass: <input type='text' name='tbPass' /> <br/>
		<input type='submit' name='btnCreateAccount' value='Create account'/>
	</form>




  <br/><br/><hr/><br><br/>


<h2> 2. Login</h2>
<form action='login_user' method='POST' >
  name: <input type='text' name='tbName' /> <br/>
  pass: <input type='text' name='tbPass' /> <br/>
  <input type='hidden' name='name_func' value='login'>
  <input type='submit' name='btnLogin' value='Login'/>
</form>

<?php

  if(isset($_SESSION['user_id'])) {
    echo "you are LOGGED IN";
  }
  else {
    echo "you are NOT LOGGED IN";
  }
?>



<br/><br/><hr/><br><br/>



<h2> 3. Create Article </h2>

<?php
    if(isset($_SESSION['user_id'])) {
?>
<form action='create_article' method='POST' >
  categories_id: <input type='text' name='tbCategories_id' /> <br/>
  text: <input type='text' name='tbText' /> <br/>
  title: <input type='text' name='tbTitle' /> <br/>
  <input type='submit' name='btnCreateArticle' value='Create article'/>
</form>

<?php
}
else {
  echo "First log in, and then you can create.";
}
?>






<br/><br/><hr/><br><br/>



<h2> 4. Create Categories </h2>

<?php
    if(isset($_SESSION['user_id'])) {
?>
<form action='create_categorie' method='POST' >
  title: <input type='text' name='tbTitle' /> <br/>
  <input type='submit' name='btnCreateCategorie' value='Create categorie'/>
</form>

<?php
}
else {
  echo "First log in, and then you can create.";
}
?>









<br/><br/><hr/><br><br/>











<h2> 5. Articles (Read + Update + Delete) AND Comments</h2>
	<?php

		// >>>>>>>>>> COMMENTS >>>>>>>>>>>>
		function comments_block($comments, $article_id) {
			if(isset($_SESSION['user_id'])){
				echo "<form action='create_comment' method='POST'>";
					echo "title: <input type='text' name='tbTitle' /> *** ";
					echo "text: <input type='text' name='tbText' /> ";
					echo "<input type='hidden' name='article_id' value='" . $article_id . "'/> ";
					echo "<input type='submit' name='btnCreateComment' value='Add comment'>";
				echo "</form>";
			}
			else {
				echo "you first must loggin to post comment.";
			}
			echo "<br/>comments:<br/>";
			foreach($comments as $row) {
				if ($row->getArticles_id() != $article_id) continue;
				if (isset($_SESSION['user_id']) && $row->getUsers_id() == $_SESSION['user_id']) {
					echo "<form action='update_comment' method='POST' >";
						echo "id:" . $row->getId() . " *** ";
						echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
						echo "text: <input type='text' name='tbText' value='".$row->getText()."'/> ";
						echo "text: <input type='hidden' name='article_id' value='".$row->getArticles_id()."'/> ";
						echo "text: <input type='hidden' id='comment_id' name='comment_id' value='".$row->getId()."'/> ";
						echo "<input type='submit' name='btnUpdateComment' value='Update'/>";
            echo "<a href='javascript:void(0)' id='ajax_click_DELETE_comment'>Delete</a>";
					echo "</form>";
				}
				else
				{
					echo 'id: ' .$row->getId(). ' *** title: ' . $row->getTitle() . ' *** text: ' . $row->getText() . ', <br/>';
				}
			}

			echo "<br/>";
			echo "<br/>";
			echo "---------------------------------------------------------------------<br/>";
			echo "<br/>";
		}

		// <<<<<< COMMENTS <<<<<<<<





		// >>>>>> ARTICTLES >>>>>>>>
		foreach($articles as $row) {
			if (isset($_SESSION['user_id']) && $row->getUsers_id() == $_SESSION['user_id']) {
				echo "<form name='formArticle' action='update_article' method='POST' >";
					echo "Article => id:".$row->getId()." *** ";
					echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
					echo "text: <input type='text' name='tbText' value='".$row->getText()."'/> ";
					echo "categories_id: <input type='text' name='tbCategories_id' value='".$row->getCategories_id()."'/> ";
					echo "<input type='hidden' name='article_id' id='article_id' value='".$row->getId()."'>";
					echo "<input type='submit' name='btnUpdateArticle' value='Update'/>";
					echo "<a href='javascript:void(0)' id='ajax_click_DELETE_article'>Delete</a>";
				echo "</form>";
				comments_block($comments, $row->getId());
			}
			else
			{
				echo 'Article => id: ' .$row->getId(). ' *** title: ' . $row->getTitle() . ' *** text: ' . $row->getText() . ' *** categories_id: ' . $row->getCategories_id().', <br/>';
				comments_block($comments, $row->getId());
			}
		}

		// <<<<<<<< ARTICLES <<<<<<<<<<

	?>




















  <br/><br/><hr/><br><br/>


<h2> 6. Categories (Read + Update + Delete) </h2>
<?php
  foreach($categories as $row) {
    if (isset($_SESSION['user_id']) && $row->getUsers_id() == $_SESSION['user_id']) {
      echo "<form action='update_categorie' method='POST' >";
        echo "id: " . $row->getId() . " *** ";
        echo "title: <input type='text' name='tbTitle' value='".$row->getTitle()."'/> *** ";
        echo "<input type='hidden' id='categorie_id' name='categorie_id' value='".$row->getId()."'>";
        echo "<input type='submit' name='btnUpdateCategorie' value='Update'/>";
        echo "<a href='javascript:void(0)' id='ajax_click_DELETE_categorie'>Delete</a>";
      echo "</form>";
    }
    else
    {
      echo 'id: ' .  $row->getId()  .  ' *** title: ' . $row->getTitle() . ', <br/>';
    }
  }


?>
