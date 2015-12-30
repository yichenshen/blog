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
                <th colspan="3">
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
                        <?php echo $post->title ?>
                    </td>
                    <td>
                        <?php echo substr($post->content,0,20) ?>
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

    <nav>
        <ul class="pagination">
            <li <?php if($page === 1){ echo 'class = "disabled"';} ?> >
                <a <?php if($page !== 1){ echo 'href="' . URL . 'posts/admin/' . ($page - 1) . '"'; } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                 </a>
            </li>

            <?php foreach ($indices as $index): ?>

                <!-- Ellipsis -->
                <?php if ($index === -1): ?>
                    <li class="disabled">
                        <a>&hellip;</a>
                    </li>
                <!-- Current Page -->
                <?php elseif ($index === $page) : ?>
                    <li class="active">
                        <a>
                            <?php echo $index; ?> <span class="sr-only">(current)</span>
                        </a>
                    </li>
                <!-- Other pages -->
                <?php else: ?>
                    <li><a href="<?php echo URL . 'posts/admin/' . $index ;?>"><?php echo $index; ?></a></li>
                <?php endif; ?>
            <?php endforeach;?>

            <li <?php if($page === $total_pages){ echo 'class = "disabled"';} ?> >
                <a <?php if($page !== $total_pages){ echo 'href="' . URL . 'posts/admin/' . ($page + 1) . '"';} ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</main>
