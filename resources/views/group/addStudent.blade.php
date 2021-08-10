<div class="modal fade" id="addStudent{{ $g['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addStudent-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudent-model-Lavel">{{ 'Student qo\'shish' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('group.addStudentInGroup', [$g['id']]) }}" class="js_add_student_group_modal_from form-group">
                @csrf
                {{-- {{ method_field('PUT') }} --}}
                <div class="d-flex justify-content-around">
                    <p class="pt-2 mb-0">Yangilar</p>
                    <p class="pt-2 mb-0">Guruhdagilar</p>
                </div>
                <div class="modal-body text-left pb-0">
                    <select multiple="multiple" class="students_ingroup" name="students_ingroup[]">
                        @foreach($students as $k => $s)
                            @foreach($s['course_ids'] as $k => $v)
                                @if($v == $g['course_id'])
                                    <option value='{{ $s['id'] }}'>{{ $s['lastname']." ".$s['firstname']." ".substr($s['phone'], 4) }}</option>
                                @endif
                            @endforeach
                        @endforeach
                        @foreach($group_students as $k => $gs)
                            @if($gs->group_id == $g['id'])
                                <option value='{{ $gs->student_id }}' selected>{{ $gs->lastname." ".$gs->firstname." ".substr($gs->phone, 4) }}</option>
                            @endif;
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer mt-3 pb-0">
                    <input type="submit" value="Saqlash" class="btn btn-success btn-square">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                </div>
            </form>
        </div>
    </div>
</div>
