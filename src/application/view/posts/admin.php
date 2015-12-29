<main>
<div class="container">
  <h1>Dashboard</h1>
</div>

<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Date</th>
        <th>Title</th>
        <th>Text</th>
        <th>Author</th>
        <th>
          <a href = "<?php echo URL ?>posts/newpost" class = "btn btn-primary pull-right">New Article</a>
        </th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $post): ?>
            <tr>
                <td class="text-nowrap">
                    <?php echo date("d M  Y", strtotime($post->create_time)); ?>
                </td>
                <td>
                    <?php echo $post->title; ?>
                </td>
                <td>
                    <?php echo substr($post->content,0,20); ?>
                </td>
                <td>
                    <?php echo $post->user_username; ?>
                </td>
                <td>
                    <div class="pull-right">
                        <a href = "<?php echo URL ?>posts/show/<?php echo $post->post_id ?>">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            <span class="sr-only">Show</span>
                        </a>

                        <!-- Ommit edit and delete if logged in user does not own post. Session must be set to reach this page -->
                        <!-- This check is merely asthetic, there are server side checks for permissions -->
                        <?php if($_SESSION['user'] === $post->user_username): ?>
                            |
                            <a href = "<?php echo URL ?>posts/edit/<?php echo $post->post_id ?>">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                <span class="sr-only">Edit</span>
                            </a>
                            |
                            <form action = "<?php echo URL . "posts/delete/". $post->post_id; ?>" method = "POST" class = "delete-button">
                                <!-- Confirm delete dialog -->
                                <a  href = "#" 
                                    onclick="if(confirm(&quot;Are you sure you want to delete this post?&quot;)) this.parentNode.submit()">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    <span class="sr-only">Delete</span>
                                </a>
                            </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>    
        <?php endforeach; ?>
    </tbody>
  </table>
</div>
</main>
