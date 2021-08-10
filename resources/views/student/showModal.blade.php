<div class="modal fade" id="show{{ $s['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'quvchi haqida to\'liq ma\'lumot' }}</h5>
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
                        <td>{{ $s['firstname'] }}</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Familiyasi</td>
                        <td>{{ $s['lastname'] }}</td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Tug'ilgan sanasi</td>
                        <td>{{ date("d.m.Y", strtotime($s['born'])) }}</td>
                    </tr>
                    <tr>
                        <th>4</th>
                        <td>Telefon nomeri</td>
                        <td>{{ $s['phone'] }}</td>
                    </tr>
                    <tr>
                        <th>5</th>
                        <td>Manzili</td>
                        <td>{{ $s['address'] }}</td>
                    </tr>
                    <tr>
                        <th>6</th>
                        <td>Jinsi</td>
                        <td>@if($s['gender'] == 1) {{ 'erkak' }} @else {{ 'ayol' }} @endif</td>
                    </tr>
                    <tr>
                        <th>7</th>
                        <td>Ishi / o'qishi</td>
                        <td>{{ $s['company'] }}</td>
                    </tr>
                    <tr>
                        <th>8</th>
                        <td>Reklamani qayerda ko'rganligi</td>
                        <td>{{ $s['advertising'] }}</td>
                    </tr>
                    <tr>
                        <th class="align-middle">9</th>
                        <td class="align-middle">Tanlagan kurslari</td>
                        <td>
                            @foreach($course as $c)
                                @if(in_array($c->id, $s['course_ids']))
                                    {{ $c->name }}<br>
                                @endif
                            @endforeach
                        </td>
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
