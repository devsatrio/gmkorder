<div class="row text-center" style="padding-top: 40px">
    <div class="col-12">
        <div class="card" style="border-radius: 1em">
            <div class="card-body">
                <form action="{{route('filtering')}}" method="get">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-6 col-12 mb-3">
                            <input type="text" class="form-control form-control" name="carifg" placeholder="Cari Barang Mu ">
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-3">
                            <select name="rd" class="form-control">
                                <option value="murah">Termurah</option>
                                <option value="laris">Terlaris</option>
                                <option value="mahal">Termahal</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-lg-2 col-12">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
