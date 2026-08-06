<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use App\Models\ImportantDate; use Illuminate\Http\Request; use Inertia\Inertia;
class ImportantDateController extends Controller {
 public function index(){return Inertia::render('Admin/ImportantDates/Index',['dates'=>ImportantDate::orderBy('sort_order')->get()]);}
 public function store(Request $r){ImportantDate::create($this->data($r));return back()->with('success','Date added.');}
 public function update(Request $r,ImportantDate $importantDate){$importantDate->update($this->data($r));return back()->with('success','Date updated.');}
 public function destroy(ImportantDate $importantDate){$importantDate->delete();return back()->with('success','Date deleted.');}
 private function data(Request $r){$d=$r->validate(['title'=>['required','string','max:255'],'date'=>['nullable','date'],'description'=>['nullable','string','max:1000'],'sort_order'=>['nullable','integer','min:0']]);$d['is_highlighted']=$r->boolean('is_highlighted');$d['is_published']=$r->boolean('is_published');$d['sort_order']=$d['sort_order']??0;return $d;}
}
