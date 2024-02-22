<div class="container">
        <aside>
            <h3 class="aside_title">INÍCIO</h3>
            <div class="item_aside">
                <span class="item" onclick="showItens(0)">Tarefas</span>
                <ul class="hidden_list_aside" id="task_list">
                    <li>A fazer</li>
                    <li>Fazendo</li>
                    <li>Feitas</li>
                </ul>
            </div>
            <div class="item_aside">
                <span class="item" onclick="showItens(1)">Período</span>
                <ul class="hidden_list_aside" id="period_list">
                    <li> Mês
                        <ul>
                            <li>Todos os meses</li>
                        </ul>
                    </li>
                    <li> Ano
                        <ul>
                            <li> Todos os anos</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>