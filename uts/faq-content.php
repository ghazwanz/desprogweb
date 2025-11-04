    <table class="task-list">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Faq Title</th>
                <th>Faq Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!$rowFaq) {
            ?>
                <tr class="empty-state">
                    <td colspan="3">
                        <p>📝 There is no Faq data right now. Create a new one!</p>
                    </td>
                </tr>
                <?php
            } else {
                foreach ($rowFaq as $faq) {
                ?>
                    <tr>
                        <td><?php echo $faq['id'] ?></td>
                        <td><?php echo $faq['faq_title'] ?></td>
                        <td><?php echo $faq['faq_desc'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>