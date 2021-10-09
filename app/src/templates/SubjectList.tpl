{include file="head-html.tpl"}
    <h1>Materias de la Facultad de Ciencias Exactas</h1>
    <table>
        <thead>
            <th>
                <td>Materia</td>
                <td>Año</td>
                <td>Cuatrimestre</td>
                <td>Correlativa</td>
                <td>Carrera</td>
            </th>
        </thead>
        <tbody>
            {foreach from=$data item=$subject}
                <tr>
                    <td>{$subject.name}</td>
                    <td>{$subject.year}</td>
                    <td>{$subject.semester}</td>
                    <td>{$subject.direct_requirement}</td>
                    <td>{$subject.career}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>