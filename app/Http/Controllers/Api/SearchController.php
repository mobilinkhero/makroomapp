<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $configType = $request->input('config_type', 'config_b');
        $limit = $request->input('limit', 50);
        $offset = $request->input('offset', 0);
        
        $recordsQuery = Record::where('config_type', $configType)
            ->where('is_active', true);
        
        if ($query) {
            $recordsQuery->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            });
        }
        
        $total = $recordsQuery->count();
        $records = $recordsQuery->skip($offset)->take($limit)->get();
        
        return response()->json([
            'records' => $records->map(function($record) {
                $data = json_decode($record->data, true) ?? [];
                $fields = [
                    'title' => ['type' => 'text', 'value' => $record->title],
                    'description' => ['type' => 'text', 'value' => $record->description],
                ];
                
                // Merge additional data fields
                foreach ($data as $key => $value) {
                    $fields[$key] = $value;
                }
                
                return [
                    'id' => (string)$record->id,
                    'fields' => $fields
                ];
            }),
            'totalCount' => $total,
            'hasMore' => ($offset + $limit) < $total,
            'metadata' => [
                'query' => $query,
                'limit' => $limit,
                'offset' => $offset
            ]
        ]);
    }
}
