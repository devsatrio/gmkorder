<div class="row text-center" style="padding-top: 40px">
    <div class="col-12">
        <div class="card" style="border-radius: 1em">
            <div class="card-body">
                <form action="{{route('filtering')}}" method="get">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-lg-3 col-12 mb-3">
                            <input type="text" class="form-control form-control-sm" name="carifg" placeholder="Cari Barang Mu ">
                        </div>
                        <div class="col-4 col-md-2 col-lg-2 mb-3">
                            <div class="form-check mr-2">
                                <input class="form-check-input" name="rd" type="radio" value="laris" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                  Terlaris
                                </label>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 col-lg-2">
                            <div class="form-check mr-2">
                                <input class="form-check-input" name="rd" type="radio" value="murah" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                  Termurah
                                </label>
                            </div>
                        </div>
                        <div class="col-4 col-md-2 col-lg-2">
                            <div class="form-check mr-2">
                                <input class="form-check-input" name="rd" type="radio" value="mahal" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                  Termahal
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-3 col-12">
                            <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
