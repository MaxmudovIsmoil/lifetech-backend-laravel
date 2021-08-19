<div class="modal fade" id="show{{ $t['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'qituvchi haqida to\'liq ma\'lumot' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left pb-0">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th width="46%">First</th>
                        <th width="46%">Last</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>1</th>
                        <td>Ismi</td>
                        <td>{{ $t['firstname'] }}</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Familiyasi</td>
                        <td>{{ $t['lastname'] }}</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Telefon nomeri</td>
                        <td>{{ $t['phone'] }}</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Manzili</td>
                        <td>{{ $t['address'] }}</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>Jinsi</td>
                        <td>@if($t['gender'] == 1) {{ 'erkak' }} @else {{ 'ayol' }} @endif</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>Avvalgi valozimi</td>
                        <td>{{ $t['company'] }}</td>
                    </tr>
                    <tr>
                        <th class="align-middle">8</th>
                        <td class="align-middle">Mutaxassisligi</td>
                        <td>
                            @foreach($course as $c)
                                @if(in_array($c->id, $t['course_ids']))
                                    {{ $c->name }}<br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>9</th>
                        <td>Maqomi</td>
                        <td>
                            @if($t['status'] == 1)
                                {{ 'yangi sinovda' }}
                            @elseif($t['status'] == 2)
                                {{ 'Falo hodim' }}
                            @elseif($t['status'] == 3)
                                {{ 'Ishdan ketgan' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>10</th>
                        <td>Kelgan sanasi</td>
                        <td>{{ date('d.m.Y H:i', strtotime($t['created_at'])) }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer mt-0">
                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
            </div>
        </div>
    </div>
</div>
