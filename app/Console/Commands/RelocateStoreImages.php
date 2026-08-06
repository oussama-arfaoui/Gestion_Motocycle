<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\ProductCategorie;
use App\Models\ProductVariant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RelocateStoreImages extends Command
{
    /**
     * Usage:
     *   php artisan images:relocate            (perform the copy)
     *   php artisan images:relocate --dry-run  (only report what would happen)
     */
    protected $signature = 'images:relocate {--dry-run : Only show what would be copied, without writing files}';

    protected $description = 'Copy existing brand/variant/category image files into the storage/uploads/<subfolder> locations the storefront expects.';

    public function handle(): int
    {
        $dry = (bool) $this->option('dry-run');

        // model class => [db column, target subfolder]
        $targets = [
            [Brand::class,             'brand_img',     'brand_image'],
            [ProductVariant::class,    'image',         'family_image'],
            [ProductCategorie::class,  'categorie_img', 'product_image'],
        ];

        $copied = 0;
        $already = 0;
        $missing = 0;

        foreach ($targets as [$model, $column, $subfolder]) {
            $rows = $model::whereNotNull($column)->where($column, '!=', '')->get();

            foreach ($rows as $row) {
                $file = $row->{$column};
                if (empty($file)) {
                    continue;
                }
                // Use only the basename in case a path sneaked into the DB value
                $basename   = basename($file);
                $targetDir  = storage_path('uploads/' . $subfolder);
                $targetPath = $targetDir . DIRECTORY_SEPARATOR . $basename;

                if (File::exists($targetPath)) {
                    $already++;
                    continue;
                }

                $source = $this->findSource($basename, $subfolder);

                if ($source === null) {
                    $missing++;
                    $this->warn("MISSING  [{$subfolder}] {$basename} (id={$row->id})");
                    continue;
                }

                if ($dry) {
                    $this->line("WOULD COPY  {$source}  ->  {$targetPath}");
                    $copied++;
                    continue;
                }

                if (!File::isDirectory($targetDir)) {
                    File::makeDirectory($targetDir, 0775, true);
                }

                File::copy($source, $targetPath);
                $this->info("COPIED  {$basename}  ->  uploads/{$subfolder}/");
                $copied++;
            }
        }

        $this->newLine();
        $this->info(($dry ? '[DRY RUN] ' : '') . "Done. Copied: {$copied}, already present: {$already}, missing source: {$missing}.");

        return self::SUCCESS;
    }

    /**
     * Look for the file in the known legacy locations and return the first match.
     */
    private function findSource(string $basename, string $subfolder): ?string
    {
        $candidates = [
            storage_path('app/public/uploads/' . $subfolder . '/' . $basename),
            storage_path('app/public/uploads/' . $basename),
            storage_path('app/uploads/' . $subfolder . '/' . $basename),
            storage_path('app/uploads/' . $basename),
            storage_path('uploads/' . $basename),
            public_path('uploads/' . $subfolder . '/' . $basename),
            public_path('uploads/' . $basename),
        ];

        foreach ($candidates as $path) {
            if (File::exists($path)) {
                return $path;
            }
        }

        return null;
    }
}
