<?php require_once("./../pages/header.php") ?>

<div class="container mx-auto min-h-[90vh] p-5">
    <h2 class="text-2xl font-bold mb-6 text-[var(--primary)]">Action Logs</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-[var(--background)] border border-[var(--accent)]">
            <thead>
                <tr class="bg-[var(--secondary)]">
                    <th class="border px-4 py-2 text-[var(--text)]">Log ID</th>
                    <th class="border px-4 py-2 text-[var(--text)]">Full Name</th>
                    <th class="border px-4 py-2 text-[var(--text)]">Game Name</th>
                    <th class="border px-4 py-2 text-[var(--text)]">Action</th>
                    <th class="border px-4 py-2 text-[var(--text)]">Game ID</th>
                    <th class="border px-4 py-2 text-[var(--text)]">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr class="bg-black text-white">
                        <td class="border px-4 py-2"><?= $log['log_id'] ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($log['full_name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($log['game_name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($log['action']) ?></td>
                        <td class="border px-4 py-2"><?= $log['game_id'] ?></td>
                        <td class="border px-4 py-2"><?= $log['timestamp'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once("./../pages/footer.php") ?>