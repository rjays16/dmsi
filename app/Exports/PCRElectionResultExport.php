<?php
  
namespace App\Exports;

use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable; 
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\ElectionNominee;
use App\Models\ElectionPeriod;
use DB;
  
class PCRElectionResultExport implements WithHeadings, FromCollection, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected static $id;

    function __construct($id) {
        self::$id = $id;
    }

    public function collection() {
        $data_results = ElectionNominee::leftJoin('election_votes', 'election_nominees.id', '=', 'election_votes.election_nominee_id')
            ->join('pcr_members', 'pcr_members.id', '=', 'election_nominees.member_id')
            ->leftJoin('pcr_members as voter', 'election_votes.voted_by', '=', 'voter.id')
            ->select(
                'election_nominees.id as election_nominees_id',
                DB::raw('CONCAT_WS(", ", pcr_members.last_name, pcr_members.first_name) AS "nominee_name"'),
                'election_votes.voted_by',
                DB::raw('CONCAT_WS(", ", voter.last_name, voter.first_name) AS "voter_name"')
            )
            ->where('election_nominees.election_period_id', self::$id)
            ->orderBy('voter.last_name', 'asc')
            ->groupBy('election_votes.voted_by', 'election_nominees.id', 'pcr_members.last_name', 'pcr_members.first_name', 'voter.first_name', 'voter.last_name', 'election_nominees.member_id', 'pcr_members.id')
            ->get();

        return $data_results;
    }
    
    public function headings(): array {
        return [
            'Nominee ID',
            "Nominee's Name",
            "Voter ID",
            "Voter's Name",
        ];
    }
    
    public function registerEvents(): array {
        return [
            AfterSheet::class => [self::class, 'addCustomRow'],
        ];
    }

    public static function addCustomRow(AfterSheet $event) {
        $total_votes = ElectionPeriod::getTotalVotes(self::$id);

        $event->sheet->insertNewRowBefore(1, 2);
        $event->sheet->setCellValue('A1', 'Total Number of Voters');
        $event->sheet->setCellValue('B1', $total_votes);
    }
}