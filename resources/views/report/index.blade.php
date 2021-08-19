@extends('layouts.app')

@section('content')

        <div class="card report">
            <div class="card-body" style="position: relative;">
                <form method="post" action="{{ route('expense.reportShow') }}" class="form-group">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="startDate">Boshlangich sana</label>
                            <input type="date" name="from_date" id="from_date" class="form-control">
                            @error('from_date')
                                <div class="text-danger">Boshlang'ish sanani kiriting!</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="startEnd">Tugash sana</label>
                            <input type="date" class="form-control" name="to_date" id="to_date">
                            @error('to_date')
                                <div class="text-danger">Tugash sanani kiriting!</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Saqlash" class="btn btn-success" style="margin-top: 28px;">
                        </div>
                    </div>
                </form>

                <div class="Tolash-kerak mt-3">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr class="text-center">
                            <th>To'lash kerak</th>
                            <th>Tolaganlar soni</th>
                            <th>Jami summa</th>
                            <th>To'langan</th>
                            <th>Qarzdorlik</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>55</td>
                                <td>41</td>
                                <td>18 760 000</td>
                                <td>12 710 000</td>
                                <td>6 050 000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="student-count mt-3">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr class="text-center">
                            <th width="21%">Barcha o'quvchilar</th>
                            <th width="24%">Guruhda</th>
                            <th width="20.5%">Yakka tartibda</th>
                            <th width="34.5%">Jami</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="text-left">Erkaklar</td>
                                <td>51</td>
                                <td>2</td>
                                <td>53</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Ayollar</td>
                                <td>1</td>
                                <td>1</td>
                                <td>2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="yonalishlar mt-3">
                    <h6 class="alert alert-block alert-primary text-center pt-2 pb-2 mb-0">Yo'nalishlar</h6>
                    <table class="table table-bordered table-striped table-sm mt-1">
                        <thead>
                        <tr class="text-center">
                            <th>Nomi</th>
                            <th>To'lash kerak</th>
                            <th>To'laganlar soni</th>
                            <th>To'lashi kerak</th>
                            <th>To'lndi</th>
                            <th>Qarzdorlik</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="text-left">Kompyuter savadhonligi</td>
                                <td>22</td>
                                <td>17</td>
                                <td>6 705 000</td>
                                <td>4 555 000</td>
                                <td>2 150 000</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Web dasturlash</td>
                                <td>22</td>
                                <td>17</td>
                                <td>6 705 000</td>
                                <td>4 555 000</td>
                                <td>2 150 000</td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Java</td>
                                <td>22</td>
                                <td>17</td>
                                <td>6 705 000</td>
                                <td>4 555 000</td>
                                <td>2 150 000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="mutaxasis-report mt-3">
                    <h6 class="alert alert-block alert-primary text-center pt-2 pb-2 mb-0">Mutahasis statistikasi</h6>
                    <table class="table table-bordered table-striped table-sm mt-1">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">№</th>
                                <th>Ism familiya</th>
                                <th>O'quvchisi</th>
                                <th>To'lashi kerak</th>
                                <th>To'lov</th>
                                <th>Qarzdorligi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center">1</th>
                                <td><a href="">Soataliyev Oybekjon</a></td>
                                <td>28</td>
                                <td>9 835 000</td>
                                <td>5 585 000</td>
                                <td>4 250 000</td>
{{--                                <td>{{ number_format(40*(4700), 0,", "," ") }}</td>--}}
                            </tr>
                            <tr>
                                <th class="text-center">2</th>
                                <td><a href=""> O'rinboy</a></td>
                                <td>19</td>
                                <td>5 635 000</td>
                                <td>5 585 000</td>
                                <td>4 250 000</td>
                            </tr>
                            <tr>
                                <th class="text-center">3</th>
                                <td><a href="">Solijon</a></td>
                                <td>28</td>
                                <td>9 835 000</td>
                                <td>5 585 000</td>
                                <td>4 250 000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- <td>{{ number_format(40*(4700), 0,", "," ") }}</td> --}}

                <div class="dars-uchun-report mt-3">
                    <h6 class="alert alert-block alert-primary text-center pt-2 pb-2 mb-0">Dars uchun oylik maosh</h6>
                    <table class="table table-bordered table-striped table-sm mt-1">
                        <thead>
                            <tr>
                                <th>Fish</th>
                                <th>Tushurgan pul</th>
                                <th>Oyligi</th>
                                <th>Oylik (%)</th>
                                <th>Ustama (%)</th>
                                <th>Keltirgan foyda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Soataliyev Oybekjon</td>
                                <td>5 585 000</td>
                                <td>2 234 000</td>
                                <td>40%</td>
                                <td>0%</td>
                                <td>3 351 000</td>
                            </tr>
                            <tr>
                                <td>O'rinboy</td>
                                <td>4 565 000</td>
                                <td>1 834 000</td>
                                <td>40%</td>
                                <td>0%</td>
                                <td>2 351 000</td>
                            </tr>
                            <tr>
                                <td>Solijon</td>
                                <td>5 585 000</td>
                                <td>2 234 000</td>
                                <td>40%</td>
                                <td>0%</td>
                                <td>3 351 000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="qoshimcha-oyki mt-3">
                    <h6 class="alert alert-block alert-primary text-center pt-2 pb-2 mb-0">Qo'shimcha ishlar uchun oylik maosh</h6>
                    <table class="table table-bordered table-striped table-sm mt-1">
                        <thead>
                        <tr>
                            <th>Fish</th>
                            <th>Oyligi</th>
                            <th>Oylik ishiga</th>
                            <th>Oylik (%) jami summa</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Soataliyev Oybekjon</td>
                                <td>-</td>
                                <td>-</td>
                                <td>0%</td>
                            </tr>
                            <tr>
                                <td>Abrorjon</td>
                                <td>635 500</td>
                                <td>-</td>
                                <td>5%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="oylik-qolga-tegishi mt-3">
                    <h6 class="alert alert-block alert-primary text-center pt-2 pb-2 mb-0">Oylik qo'lga tegishi</h6>
                    <table class="table table-bordered table-striped table-sm mt-1">
                        <thead>
                            <tr>
                                <th>Fish</th>
                                <th>Qo'lga tegishi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Soataliyev Oybekjon</td>
                                <td>2 234 000</td>
                            </tr>
                            <tr>
                                <td>Orinboy</td>
                                <td>1 834 000</td>
                            </tr>
                            <tr>
                                <td>Abrorjon</td>
                                <td>6 500 000</td>
                            </tr>
                            <tr>
                                <td>Zorikjon</td>
                                <td>1 200 000</td>
                            </tr>
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>Jami summa</th>
                                <th>1 200 000</th>
                            </tr>
                        </tfooter>
                    </table>
                </div>


                <div class="chiqim">
                    <h6>Chiqimlar</h6>
                    <table class="table table-bordered table-striped table-sm">
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
                    <h6>Natija</h6>
                    <table class="table table-bordered table-striped table-sm">
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


@endsection
