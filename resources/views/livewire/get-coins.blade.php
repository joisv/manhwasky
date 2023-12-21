<div class="max-w-4xl p-2 mx-auto" x-data="{
    countdown: 20,
    btnScroll: true,
    shownBtn: false,
    token: @entangle('token').live,
    
    init() {
        //lakukan pengecekan jika tidak ada token jangan lakukan countdown
        const intervalId = setInterval(() => {
            if (this.countdown > 0) {
                this.countdown--
            }else{
                clearInterval(intervalId);
                this.btnScroll = false;
            }
        }, 1000)
    },
    handleScroll(){
        window.location.href = '#halo';
        this.shownBtn = true;
    }
}">
    <div class="w-full flex flex-col justify-center items-center space-y-6">
        <h1 class="font-comicBold text-2xl">Dapatkan 2 coin dengan click tombol dibawah</h1>
        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center">
            <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center">
                <p x-text="countdown" class="font-comicBold text-lg"></p>
            </div>
        </div>
        <button @click="handleScroll" :disabled="btnScroll" class="bg-primary w-20 disabled:opacity-75 p-1 text-white text-center font-comicBold rounded-sm block">
            get coin
        </button>
    </div>
    <div class="mt-20">
        <h1 class="font-comicBold text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h1> Impedit
        itaque voluptatum quasi ut fugit possimus necessitatibus numquam eaque explicabo natus quisquam magni
        dolorem, quidem dignissimos quo aspernatur placeat exercitationem quia ea harum, minima nobis blanditiis
        saepe. Fuga incidunt sapiente possimus soluta sunt necessitatibus error quidem eligendi distinctio deleniti
        aliquid dolorum ab itaque in magnam commodi maxime unde assumenda tenetur, asperiores accusantium doloremque
        neque. Doloremque, natus sit dolorum eligendi animi delectus eum suscipit cupiditate, libero quod mollitia
        odio culpa vitae illum a? Repellendus cumque necessitatibus tempore ab fuga, esse omnis eligendi autem
        itaque dignissimos iste obcaecati, quisquam deserunt, illo temporibus quia libero. Illum, ullam vitae. Harum
        vitae ex commodi architecto dolorem, ducimus dolore, in doloribus, laborum ab ipsum corporis. Voluptatem
        asperiores sed obcaecati repudiandae nobis non, iste maxime, dignissimos, quas blanditiis harum. Iusto,
        quos. Expedita neque possimus nisi nihil, facere itaque aut consequuntur quis reiciendis quod ratione unde
        vero sed. Cupiditate rem neque nihil, nisi assumenda placeat ipsum consectetur eaque esse veritatis
        molestias distinctio corporis incidunt ipsa, voluptates consequatur explicabo, asperiores omnis. Quas
        nostrum rem libero, distinctio iure, architecto eos quia sunt vel, dolore illo modi. Natus similique magnam
        voluptas nihil, rerum aut sit dolore. Fuga magni eligendi tempora quidem sequi quaerat est, hic totam omnis
        sunt sed accusantium voluptas cupiditate eaque temporibus quam? Quis harum voluptates asperiores reiciendis
        recusandae officiis magnam soluta illo nisi, dicta hic ipsa ab, ea dolores repellendus, aliquid facilis? Qui
        dolorem dignissimos tempore, eaque dicta maxime ipsum aliquam esse nisi corrupti nobis, a sequi doloremque
        perferendis possimus harum eum ut? Earum, neque totam nobis tempora mollitia accusamus minus officia
        consequuntur officiis nihil. Tenetur quibusdam laudantium optio eveniet neque sed iure harum mollitia
        explicabo, quisquam, commodi, odio adipisci ipsam rem blanditiis? Voluptate, praesentium? In accusamus est
        ab odit repellat, id tenetur cum architecto consectetur. Qui dolorum necessitatibus sequi temporibus eius,
        iste animi repellendus consequuntur assumenda iure voluptate pariatur? Vel iste id nostrum, fugiat
        perferendis est alias nesciunt, dolor dignissimos inventore, eius dicta numquam. Nobis quidem eligendi porro
        delectus architecto temporibus minima itaque ipsa, minus dolores? Inventore optio esse quaerat, quod
        voluptatum nemo nam sed tempora cum ea? Beatae et laudantium fugit repellat praesentium ex illum possimus
        adipisci facere! Quam odit veritatis architecto quasi, illo obcaecati consequuntur suscipit quisquam illum
        nam blanditiis dolorem enim, molestiae adipisci voluptatibus fugiat voluptatem eos repudiandae numquam? A
        quod esse doloremque quaerat! Accusantium culpa sapiente dolorem vel. Dolorum vitae debitis veniam nemo
        officiis quia incidunt corrupti provident, maxime alias quod iste doloremque excepturi nihil voluptatem
        necessitatibus molestias omnis nobis. Rerum dolore facere magni repellat quod totam deserunt tempore id
        minus eius vitae ipsa maxime, sint suscipit debitis, necessitatibus in. Porro eligendi quisquam optio
        cupiditate nobis blanditiis in quod autem eveniet recusandae molestiae illum eos aut dolores libero velit,
        iure voluptatibus minima repudiandae error reprehenderit, corrupti sint vel! Exercitationem aspernatur
        pariatur odio, autem architecto at officiis laudantium nisi voluptate. Voluptas molestiae reiciendis ipsum
        sunt consequatur, optio dignissimos similique mollitia minus officia odit animi, excepturi deleniti sequi
        blanditiis ducimus ea! Debitis quidem consequuntur quas sapiente nobis voluptatem tempore magni harum
        maxime, natus deleniti voluptatum, rerum, odio dolores aperiam. Corporis voluptatum quos ut autem! Qui
        dignissimos officia explicabo quidem at eligendi cum atque dicta nobis ut consectetur dolorem, unde
        voluptatum aliquam quia ea illum eveniet! Earum non eius maiores aliquid cupiditate odio! Nulla laborum
        facere dicta! Totam facilis veniam nobis magni beatae, ducimus culpa ullam vitae in sequi? Tenetur, soluta
        quas commodi nemo facere iste optio autem expedita deleniti odit necessitatibus sint recusandae deserunt
        veritatis ut harum possimus delectus officia sequi ullam! Suscipit assumenda id accusamus quasi nobis
        doloribus, sapiente autem, nesciunt nemo cum officia amet, quidem quaerat necessitatibus officiis dolore
        repudiandae rerum voluptatibus quae ratione non dolores error cumque fugit! Tempore quaerat inventore qui
        minima in numquam nihil, esse ullam totam, alias voluptates incidunt nostrum, sequi quisquam excepturi
        voluptatibus explicabo voluptate distinctio beatae? Quam, accusantium amet expedita similique ex harum
        maxime, perferendis eligendi nesciunt facilis excepturi alias soluta cupiditate minima odio dolore
        accusamus, exercitationem dolorum sed impedit ipsum earum pariatur nihil veniam. Saepe quas beatae iure
        natus ratione animi doloremque sunt amet harum? Culpa cumque quibusdam ducimus qui consequatur totam
        voluptate iste architecto fuga inventore tenetur, ad, eligendi sint recusandae libero provident corporis
        rerum exercitationem? Mollitia beatae maiores libero corporis, quae amet voluptate dignissimos velit sit sed
        ut reiciendis illum. Ipsum natus neque ad perspiciatis cupiditate sapiente placeat libero nemo, dolorum qui
        labore ex voluptatem veniam iste nostrum repellendus cum necessitatibus vitae ipsa consequuntur illo quos,
        sequi rerum? Aspernatur amet obcaecati quibusdam quis suscipit neque laudantium ratione molestiae quidem.
        Labore ut hic fugit sint accusantium placeat numquam quas dolorem, aut excepturi totam harum! Inventore
        dolore in quo atque iure adipisci repudiandae, optio minus labore aut commodi molestias hic quod modi cum,
        voluptate aspernatur numquam doloremque possimus, ut dolor consectetur? Provident, laborum debitis
        perferendis id labore natus, expedita asperiores sunt suscipit eligendi officia hic, sapiente eum? Earum
        eligendi ipsa sed eum voluptates pariatur assumenda, odio culpa hic amet perspiciatis illo illum aliquam
        repellat consequatur aperiam voluptatibus praesentium rem consequuntur totam. Pariatur exercitationem
        consectetur quibusdam obcaecati ex eius culpa? Exercitationem, sit. Quod similique, tempore nesciunt fugit
        ducimus veniam accusantium atque, culpa, quidem laboriosam quibusdam quia vel. Ab sed beatae deleniti amet.
        Est eligendi quam quas nostrum dolorem eius voluptatem labore quisquam fuga facilis reprehenderit cumque ea
        et in ex, magnam nisi velit doloribus alias! Perferendis mollitia blanditiis officia praesentium iusto nulla
        eius perspiciatis consectetur dolor corrupti qui alias numquam, necessitatibus cumque expedita dicta
        eligendi voluptate accusantium! Sed recusandae dolore repellat adipisci, rerum dolorem commodi inventore
        nihil labore accusantium, veritatis aspernatur ipsam officia? Harum omnis debitis velit? Doloremque magnam
        natus totam mollitia, quam enim reprehenderit dignissimos illo iusto nostrum alias, quae tenetur. Modi magni
        ducimus amet quis, optio eos temporibus placeat blanditiis corporis repellendus aperiam nam facilis libero
        reprehenderit necessitatibus impedit exercitationem debitis? Possimus, nobis nostrum, ad officiis inventore
        adipisci enim suscipit accusamus distinctio vitae dicta beatae molestiae velit, odit et voluptatum ex nulla!
        Earum est nulla sapiente sequi ea, omnis fugit commodi sed nobis, id magnam error.
    </div>
    <div class="flex w-full items-center justify-center">
        <button x-show="shownBtn" id="halo" class="bg-primary w-20 disabled:opacity-50 p-1 text-white text-center font-comicBold rounded-sm block">
            get coin
        </button>
    </div>
</div>