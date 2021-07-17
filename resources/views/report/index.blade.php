@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card report">
                <div class="btn-group btn-square">
                    <a href="{{ route('student.index',[1]) }}" class="btn btn-square @if(Request::segment(2) == 1) btn-primary @else btn-secondary @endif">Pul bo'yicha</a>
                    <a href="{{route('student.index',[2])  }}" class="btn btn-square @if(Request::segment(2) == 2) btn-primary @else btn-secondary @endif">Guruhlar bo'yicha</a>
                </div>
                <div class="card-body" style="position: relative;">
                    <form action="" method="POST" class="d-flex justify-content-around">
                        <input type="date" name="start_date" class="form-control mr-4" placeholder="Boshlanish sana" required />
                        <input type="date" name="end_date"  class="form-control mr-4" placeholder="Tugash sana" required />
                        <input type="submit" name="see" class="btn btn-primary" value="Ko'rish">
                    </form>

                    <div class="kirim mt-3">
                        <h4>Kirimlar</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5 class="text-center" %" class="text-center">№</th>
                                    <th>Ism familiya</th>
                                    <th>Summa</th>
                                    <th>O'qituvchi ulushi</th>
                                    <th>O'qituvchi daromadi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center">1</th>
                                    <td><a href="" class="">Soataliyev Oybekjon</a></td>
                                    <td>4 700 000</td>
                                    <td>40%</td>
                                    <td>{{ number_format(40*(4700), 0,", "," ") }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">2</th>
                                    <td><a href="">Naziraliyev O'rinboy</a></td>
                                    <td>3 500 000</td>
                                    <td>40%</td>
                                    <td>{{ number_format(40*(3500), 0,", "," ") }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">3</th>
                                    <td><a href="">Aliyev Solijon</a></td>
                                    <td>3 900 000</td>
                                    <td>40%</td>
                                    <td>{{ number_format(40*(3900), 0,", "," ") }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">4</th>
                                    <td><a href="">Usmonxo'jayev Shohruhxon</a></td>
                                    <td>4 200 000</td>
                                    <td>40%</td>
                                    <td>{{ number_format(40*(4200), 0,", "," ") }}</td>
                                </tr>
                                <tr style="background: #23197cb8;color: white">
                                    <th></th>
                                    <th>Jami</th>
                                    <th>5400 000</th>
                                    <th></th>
                                    <th>5400 000</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="chiqim">
                        <h4>Chiqimlar</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">№</th>
                                <th>Chiqim turi</th>
                                <th>Vaqtlari</th>
                                <th>Summa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class="text-center">1</th>
                                <td>Svetga</td>
                                <td>12.07.2021 10:24</td>
                                <td>120 000</td>
                            </tr>
                            <tr>
                                <th class="text-center">2</th>
                                <td>Intenet hizmati</td>
                                <td>12.07.2021 10:24</td>
                                <td>70 000</td>
                            </tr>
                            <tr>
                                <th class="text-center">3</th>
                                <td>Reklamaga</td>
                                <td>12.07.2021 10:24</td>
                                <td>1700 000</td>
                            </tr>
                            <tr>
                                <th class="text-center">4</th>
                                <td>O'qituvchi Zokirjon darsdan ulishi</td>
                                <td>12.07.2021 10:24</td>
                                <td>1250 000</td>
                            </tr>
                            <tr>
                                <th class="text-center">5</th>
                                <td>O'qituvchi Oybek darsdan ulishi</td>
                                <td>12.07.2021 10:24</td>
                                <td>1100 000</td>
                            </tr>
                            <tr>
                                <th class="text-center">6</th>
                                <td>O'qituvchi Test darsdan ulishi</td>
                                <td>12.07.2021 10:24</td>
                                <td>315 000</td>
                            </tr>
                            <tr style="background: #23197cb8;color: white">
                                <th></th>
                                <th>Jami</th>
                                <th></th>
                                <th>2835 000</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="natija">
                        <h4>Natija</h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Jami tushim</th>
                                <th>Jami chiqim</th>
                                <th>Natija</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="background: #23197cb8;color: white">
                                <th>5400 000</th>
                                <th>2835 000</th>
                                <th>2565 000</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
