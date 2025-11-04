
    <table class="task-list">
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Feature Title</th>
                <th>Feature Description</th>
                <th>Images</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!$rowFaq) {
            ?>
                <tr class="empty-state">
                    <td colspan="3">
                        <p>📝 There is no Feature data right now. Create a new one!</p>
                    </td>
                </tr>
                <?php
            } else {
                foreach ($rowFeature as $feature) {
                ?>
                    <tr>
                        <td><?php echo $feature['id'] ?></td>
                        <td><?php echo $feature['feature_title'] ?></td>
                        <td><?php echo $feature['feature_desc'] ?></td>
                        <td><img src=<?= "./img/" . htmlspecialchars($feature["image_file_name"]); ?> width="100" alt=""></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>