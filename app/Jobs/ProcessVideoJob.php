<?

namespace App\Jobs;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ProcessVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $originalPath;
    public $compressedPath;
    public $thumbnailPath;

    /**
     * Create a new job instance.
     */
    public function __construct($originalPath, $compressedPath, $thumbnailPath)
    {
        $this->originalPath = $originalPath;
        $this->compressedPath = $compressedPath;
        $this->thumbnailPath = $thumbnailPath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // إنشاء كائن FFmpeg
        $ffmpeg = FFMpeg::create();

        // فتح الفيديو
        $video = $ffmpeg->open($this->originalPath);

        // استخراج صورة مصغرة
        $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(1))
              ->save($this->thumbnailPath);

        // ضغط الفيديو
        $video->save(new X264(), $this->compressedPath);
    }
}
