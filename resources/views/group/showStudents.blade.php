<div class="modal fade" id="showStudent{{ $g['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ $g['name'] . ' guruhidagi o\'quvchilar' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-left p-0">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th class="text-center">№</th>
                        <th>Ismi</th>
                        <th>Familiyasi</th>
                        <th>Telefon nomeri</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 1;
                    @endphp
                        @foreach($group_students as $k => $gs)
                            @if($gs->group_id == $g['id'])
                                <tr>
                                    <td class="text-center">{{ ($i++) }}</td>
                                    <td>{{ $gs->firstname }}</td>
                                    <td>{{ $gs->lastname }}</td>
                                    <td>{{ substr($gs->phone, 4) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @php
                      $i = 0;
                    @endphp
                    </tbody>
                </table>
            </div>

            <div class="modal-footer pt-2 pb-2">
                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
            </div>

        </div>
    </div>
</div>
