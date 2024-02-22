<div class="card-body">
                        <!-- 検索フォーム -->
                        <form action="{{ route('admin.search') }}" method="GET" class="form-inline mb-3">
                            <div class="form-group mr-2">
                                <input type="text" name="query" class="form-control" placeholder="検索">
                            </div>
                            <button type="submit" class="btn btn-primary">検索</button>
                        </form>

                        <!-- ここに他のコンテンツを追加 -->
                    </div>